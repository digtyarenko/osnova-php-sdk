<?php declare(strict_types=1);

namespace Osnova\Api;

use EntityBuilder\EntityBuilder;
use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Common\Response\Response;
use Osnova\Api\Common\Support\Storage\ArrayOfModel;
use Osnova\Api\Component\Enum\Enum;
use Osnova\Api\Component\Enum\ModeEnum;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Exception\UnexpectedMethodException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response as ClientResponse;
use Osnova\Api\Helper\Utils;

/**
 * Class Caller
 * @package Osnova\Api
 */
class Caller
{
    public const FORBIDDEN_CODE = 403;
    public const BAD_REQUEST_CODE = 400;

    public const BAD_REQUEST_MESSAGE = 'Only logged users can edit Content';

    private Api $api;
    private string $method;
    private string $entityClass;
    private string $uri;
    private array $params;

    public function __construct(Api $api)
    {
        $this->api = $api;
        $this->setMethod(Method::GET);
    }

    public function setMethod(string $method): Caller
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * @param string|null $entityClass
     * @return $this
     */
    public function buildEntity(string $entityClass = null): Caller
    {
        if (null !== $entityClass) {
            $this->entityClass = $entityClass;
        }

        return $this;
    }

    /**
     * @param string $path
     * @param array $params
     * @return $this
     */
    public function prepare(string $path, array $params = []): Caller
    {
        $this->uri = $this->getUri($path);
        $this->params = $params;

        return $this;
    }

    /**
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function call(): IResponse
    {
        try {
            $this->params = Utils::prepareParams($this->method, $this->params);
        } catch (UnexpectedMethodException $e) {
            $this->params = [];
        }

        $client = $this->makeClient();

        try {
            $response = $client->request(
                $this->method,
                $this->uri,
                $this->params
            );

            return $this->prepareResponse($response);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $preparedResponse = $this->prepareResponse($response);

            if (self::FORBIDDEN_CODE === $response->getStatusCode()
                || (self::BAD_REQUEST_CODE === $response->getStatusCode()
                    && self::BAD_REQUEST_MESSAGE === $preparedResponse->getMessage())) {
                throw new TokenRequiredException($preparedResponse->getMessage(), $response->getStatusCode());
            }

            return $preparedResponse;
        } catch (\Throwable $t) {
            throw new OsnovaApiException($t->getMessage(), $t->getCode());
        }
    }

    /**
     * @return Client
     */
    protected function makeClient(): Client
    {
        return new Client([
            'base_uri' => $this->getComputedUrl(),
            'headers'  => $this->getHeaders(),
        ]);
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        $headers = [];

        if ($this->api->getConfig()->hasToken()) {
            $headers['X-Device-Token'] = $this->api->getConfig()->getToken();
        }

        if ($this->api->getConfig()->hasUserAgent()) {
            $headers['User-agent'] = $this->api->getConfig()->getUserAgent();
        }

        if (Method::POST === $this->method) {
            $headers['Content-Type'] = 'multipart/form-data';
        }

        return $headers;
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getUri(string $path): string
    {
        return trim($path, '/');
    }

    /**
     * @return string
     */
    protected function getComputedUrl(): string
    {
        return sprintf(
            'https://api.%s/v%s/',
            $this->api->getConfig()->getDomain(),
            $this->api->getConfig()->getVersion()
        );
    }

    /**
     * @param ClientResponse $response
     * @return IResponse
     */
    protected function prepareResponse(ClientResponse $response): IResponse
    {
        $mode = $this->api->getConfig()->getMode();
        $data = json_decode($response->getBody()->getContents(), true);

        if (ModeEnum::MODE_RAW === $mode) {
            return new Response($data);
        }

        if (array_key_exists('result', $data) && $this->needToBuildEntities()) {
            $data['result'] = $this->buildEntities($data['result']);
        }

        return new Response($data);
    }

    /**
     * @return bool
     */
    protected function needToBuildEntities(): bool
    {
        return ModeEnum::MODE_ENTITY === $this->api->getConfig()->getMode() && !empty($this->entityClass);
    }

    /**
     * @param array $result
     * @return array|mixed|null
     */
    protected function buildEntities(array $result)
    {
        return (new EntityBuilder([Model::class], true))
            ->customFillProperty(function (object $entity, string $propertyName, string $targetEntityClass, $value) {
            switch (true) {
                case is_subclass_of($targetEntityClass, ArrayOfModel::class):
                    $targetEntity = $targetEntityClass::ENTITY;
                    /** @noinspection PhpUndefinedMethodInspection */
                    $entity->{$propertyName} = new $targetEntityClass($this->buildArrayOfEntities(
                        $targetEntity,
                        $value
                    ));
                    break;
                case is_subclass_of($targetEntityClass, Enum::class):
                    $entity->{$propertyName} = new $targetEntityClass($value);
                    break;
            }
        })
            ->build($this->entityClass, $result);
    }
}
