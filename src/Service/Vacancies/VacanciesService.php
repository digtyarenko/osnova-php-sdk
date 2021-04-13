<?php declare(strict_types=1);

namespace Osnova\Api\Service\Vacancies;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Custom\JobFiltersResultObject;
use Osnova\Api\Component\Model\Custom\VacanciesResultObject;
use Osnova\Api\Component\Model\Vacancy;
use Osnova\Api\Exception\InvalidEntityClassException;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\InvalidTokenException;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Exception\UnexpectedResultTypeException;
use Osnova\Api\Service\BaseService;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Vacancies
 * @package Osnova\Api\Service\Vacancies
 */
class VacanciesService extends BaseService
{
    public const SERVICE = 'Vacancies';

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getJob
     *
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getJob(): IResponse
    {
        return $this
            ->prepare('job')
            ->buildEntity(VacanciesResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getJobMore
     *
     * @param int $lastId
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getJobMore(int $lastId): IResponse
    {
        return $this
            ->prepare("job/more/{$lastId}")
            ->buildEntity(VacanciesResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getJobFilters
     *
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getJobFilters(): IResponse
    {
        return $this
            ->prepare('job/filters')
            ->buildEntity(JobFiltersResultObject::class)
            ->call();
    }

    /**
     * @see https://cmtt-ru.github.io/osnova-api/redoc.html#operation/getVacancies
     *
     * @return IResponse
     * @throws InvalidEntityClassException
     * @throws InvalidParametersException
     * @throws InvalidTokenException
     * @throws OsnovaApiException
     * @throws UnexpectedResultTypeException
     */
    public function getVacancies(): IResponse
    {
        return $this
            ->prepareWithName('widget')
            ->buildEntity(Vacancy::class)
            ->call();
    }
}
