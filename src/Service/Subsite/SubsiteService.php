<?php declare(strict_types=1);

namespace Osnova\Api\Service\Subsite;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Common\Params\CountOffsetParams;
use Osnova\Api\Component\Model\Custom\SubsiteVacanciesObject;
use Osnova\Api\Component\Model\Entry;
use Osnova\Api\Component\Model\Subsite;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;
use Osnova\Api\Service\Subsite\Enum\SortingEnum;
use Osnova\Api\Service\Subsite\Enum\TypeEnum;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Subsite
 * @package Osnova\Api\Service\Subsite
 */
class SubsiteService extends BaseService
{
    public const SERVICE = 'Subsite';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsite
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsite(int $id): IResponse
    {
        return $this
            ->prepareWithName("{$id}")
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsiteTimeline
     *
     * @param int $id
     * @param SortingEnum $sorting
     * @param int|null $count
     * @param int|null $offset
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsiteTimeline(int $id, SortingEnum $sorting, int $count = null, int $offset = null): IResponse
    {
        return $this
            ->prepareWithName(sprintf('%s/timeline/%s', $id, (string) $sorting), new CountOffsetParams($count, $offset))
            ->buildEntity(Entry::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsitesList
     *
     * @param TypeEnum $type
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsitesList(TypeEnum $type): IResponse
    {
        return $this
            ->prepare(sprintf('/subsites_list/%s', (string) $type))
            ->buildEntity(Subsite::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsiteVacancies
     *
     * @param int $subsiteId
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsiteVacancies(int $subsiteId): IResponse
    {
        return $this
            ->prepareWithName("{$subsiteId}/vacancies")
            ->buildEntity(SubsiteVacanciesObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsiteVacanciesMore
     *
     * @param int $subsiteId
     * @param int $lastId
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsiteVacanciesMore(int $subsiteId, int $lastId): IResponse
    {
        return $this
            ->prepareWithName("{$subsiteId}/vacancies/more/{$lastId}")
            ->buildEntity(SubsiteVacanciesObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsiteSubscribe
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsiteSubscribe(int $id): IResponse
    {
        return $this
            ->prepareWithName("{$id}/subscribe")
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getSubsiteUnsubscribe
     *
     * @param int $id
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getSubsiteUnsubscribe(int $id): IResponse
    {
        return $this
            ->prepareWithName("{$id}/unsubscribe")
            ->call();
    }
}
