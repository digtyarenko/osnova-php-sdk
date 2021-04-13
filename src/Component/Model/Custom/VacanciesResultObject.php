<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfVacancy;
use Osnova\Api\Component\Model\Model;

/**
 * @see https://cmtt-ru.github.io/osnova-api/redoc.html#tag/Vacancies
 * @package Osnova\Api\Component\Model\Custom
 */
class VacanciesResultObject extends Model
{
    public ArrayOfVacancy $items;
    public int $last_id;
}
