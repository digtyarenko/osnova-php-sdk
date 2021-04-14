<?php declare(strict_types=1);

namespace Osnova\Api\Service\Blacklist;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Method;
use Osnova\Api\Component\Model\Subsite;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Blacklist\Enum\ActionEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Blacklist
 * @package Osnova\Api\Service\Blacklist
 */
class BlacklistService extends BaseService
{
    public const SERVICE = 'Blacklist';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postContentMute
     *
     * @param int $id
     * @param ActionEnum $action
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postContentMute(int $id, ActionEnum $action): IResponse
    {
        return $this
            ->prepare('content/mute', [
                'id' => $id,
                'action' => $action,
            ])
            ->setMethod(Method::POST)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postHashtagMute
     *
     * @param int $id
     * @param ActionEnum $action
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postHashtagMute(int $id, ActionEnum $action): IResponse
    {
        return $this
            ->prepare('hashtag/mute', [
                'id' => $id,
                'action' => $action,
            ])
            ->setMethod(Method::POST)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/postSubsitegMute
     *
     * @param int $id
     * @param ActionEnum $action
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function postSubsiteMute(int $id, ActionEnum $action): IResponse
    {
        return $this
            ->prepare('subsite/mute', [
                'id' => $id,
                'action' => $action,
            ])
            ->setMethod(Method::POST)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getIgnoresHashtags
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getIgnoresHashtags(): IResponse
    {
        return $this
            ->prepare('ignores/hashtags')
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getIgnoresSubsites
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getIgnoresSubsites(): IResponse
    {
        return $this
            ->prepare('ignores/subsites')
            ->buildEntity(Subsite::class)
            ->call();
    }
}
