<?php declare(strict_types=1);

namespace Osnova\Api;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Common\Response\ErrorResponse;
use Osnova\Api\Common\Response\Response;
use Osnova\Api\Component\Enum\ModeEnum;
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
    public const FORBIDDEN_REASON = 'Forbidden';

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

            if (self::FORBIDDEN_CODE === $response->getStatusCode()
                && self::FORBIDDEN_REASON === $response->getReasonPhrase()) {
                $preparedResponse = $this->prepareResponse($response);
                throw new TokenRequiredException($preparedResponse->getMessage(), $response->getStatusCode());
            }

            return $this->prepareResponse($response);
        } catch (\Throwable $t) {
            throw new OsnovaApiException($t->getMessage(), $t->getCode(), $t);
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
     * @throws OsnovaApiException
     */
    protected function prepareResponse(ClientResponse $response): IResponse
    {
        $mode = $this->api->getConfig()->getMode();
        $rawData = json_decode($response->getBody()->getContents(), ModeEnum::MODE_RAW === $mode);

        if ((is_object($rawData) && property_exists($rawData, 'error'))
            || (is_array($rawData) && array_key_exists('error', $rawData))) {
            return new ErrorResponse($rawData);
        }

        if (ModeEnum::MODE_ENTITY === $mode) {
            $data = new \stdClass();
            $data->result = [];
            $data->message = $rawData->message;

            if (property_exists($rawData, 'result')) {
                $data->result = $this->needToBuildEntity()
                    ? (new EntityBuilder($rawData->result, $this->entityClass))->build()
                    : $rawData->result;
            }

            return new Response($data);
        }

        return new Response($rawData);
    }

    /**
     * @return bool
     */
    protected function needToBuildEntity(): bool
    {
        return ModeEnum::MODE_ENTITY === $this->api->getConfig()->getMode() && !empty($this->entityClass);
    }
}
