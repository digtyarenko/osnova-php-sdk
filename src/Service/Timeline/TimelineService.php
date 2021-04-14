<?php declare(strict_types=1);

namespace Osnova\Api\Service\Timeline;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Params\CountOffsetParams;
use Osnova\Api\Component\Model\Entry;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Timeline\Enum\CategoryEnum;
use Osnova\Api\Service\Timeline\Enum\SortingEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Timeline
 * @package Osnova\Api\Service\Timeline
 */
class TimelineService extends BaseService
{
    public const SERVICE = 'Timeline';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getTimeline
     *
     * @param CategoryEnum $category
     * @param SortingEnum $sorting
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getTimeline(CategoryEnum $category, SortingEnum $sorting, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName(sprintf('%s/%s', (string) $category, (string) $sorting), new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getTimelineByHashtag
     *
     * @param string $hashtag
     * @param int|null $lastId
     * @param int|null $limit
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getTimelineByHashtag(string $hashtag, int $lastId = null, int $limit = null): IResponse
    {
        return $this
            ->prepareWithName('mainpage', [
                'hashtag' => $hashtag,
                'last_id' => $lastId,
                'limit' => $limit,
            ])
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getTimelineNews
     *
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getTimelineNews(int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepare('news/default/recent', new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getFlashholder
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getFlashholder(): IResponse
    {
        return $this
            ->prepare('getflashholdedentry')
            ->buildEntity(Entry::class)
            ->call();
    }
}
