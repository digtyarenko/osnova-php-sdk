<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfVacancy;
use Osnova\Api\Component\Model\Model;

/**
 * Class SubsiteVacanciesObject
 * @package Osnova\Api\Component\Model\Custom
 */
class SubsiteVacanciesObject extends Model
{
    public ArrayOfVacancy $items;
    public int $last_id;
}
