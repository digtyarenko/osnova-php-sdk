<?php declare(strict_types=1);

namespace Osnova\Api\Service\Events;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Custom\EventsFiltersResultObject;
use Osnova\Api\Component\Model\Custom\EventsResultObject;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\TokenRequiredException;
use Osnova\Api\Service\BaseService;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Events
 * @package Osnova\Api\Service\Events
 */
class EventsService extends BaseService
{
    public const SERVICE = 'Events';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEventsFilters
     *
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEventsFilters(): IResponse
    {
        return $this
            ->prepareWithName('filters')
            ->buildEntity(EventsFiltersResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEvents
     *
     * @param int|null $cityId
     * @param string|null $specializationIds
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEvents(int $cityId = null, string $specializationIds = null): IResponse
    {
        return $this
            ->prepareWithName(null, [
                'city_id' => $cityId,
                'specialization_ids' => $specializationIds
            ])
            ->buildEntity(EventsResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getEventsMore
     *
     * @param int $lastId
     * @param int|null $cityId
     * @param string|null $specializationIds
     * @return IResponse
     * @throws OsnovaApiException
     * @throws TokenRequiredException
     */
    public function getEventsMore(int $lastId, int $cityId = null, string $specializationIds = null): IResponse
    {
        return $this
            ->prepareWithName("more/{$lastId}", [
                'city_id' => $cityId,
                'specialization_ids' => $specializationIds
            ])
            ->buildEntity(EventsResultObject::class)
            ->call();
    }
}
