<?php declare(strict_types=1);

namespace Osnova\Api\Service\Webhooks;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Component\Model\Watcher;
use Osnova\Api\Exception\InvalidEntityClassException;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\InvalidTokenException;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\UnexpectedResultTypeException;
use Osnova\Api\Service\BaseService;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Webhooks-Subscriptions
 * @package Osnova\Api\Service\Webhooks
 */
class WebhooksService extends BaseService
{
    public const SERVICE = 'Webhooks';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getApiWebhooksGet
     *
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getApiWebhooksGet(): IResponse
    {
        return $this
            ->prepareWithName('get')
            ->buildEntity(Watcher::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postApiWebhookAdd
     *
     * @param string $url
     * @param string $event
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function postApiWebhookAdd(string $url, string $event): IResponse
    {
        return $this
            ->prepareWithName('add', [
                'url' => $url,
                'event' => $event,
            ])
            ->setMethod(Method::POST)
            ->buildEntity(Watcher::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postApiWebhookDel
     *
     * @param string $event
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function postApiWebhookDel(string $event): IResponse
    {
        return $this
            ->prepareWithName('del', ['event' => $event])
            ->setMethod(Method::POST)
            ->call();
    }
}
