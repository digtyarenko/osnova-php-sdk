<?php declare(strict_types=1);

namespace Osnova\Api\Service\Search;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Entry;
use Osnova\Api\Component\Model\Subsite;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Search\Enum\OrderByEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Search
 * @package Osnova\Api\Service\Search
 */
class SearchService extends BaseService
{
    public const SERVICE = 'Search';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSearch
     *
     * @param string $query
     * @param OrderByEnum|null $orderBy
     * @param int|null $page
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSearch(string $query, OrderByEnum $orderBy = null, int $page = null): IResponse
    {
        return $this
            ->prepare('search', [
                'query' => $query,
                'order_by' => $orderBy,
                'page' => $page,
            ])
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSearchSubsite
     *
     * @param string $q
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSearchSubsite(string $q): IResponse
    {
        return $this
            ->prepare('search-subsite', ['q' => $q])
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSearchHashtag
     *
     * @param string $q
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSearchHashtag(string $q): IResponse
    {
        return $this->prepare('search-hashtag', ['q' => $q])->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getTag
     *
     * @param string $text
     * @param int $lastId
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getTag(string $text, int $lastId): IResponse
    {
        return $this
            ->prepare('tag', [
                'text' => $text,
                'last_id' => $lastId,
            ])
            ->buildEntity(Entry::class)
            ->call();
    }
}
