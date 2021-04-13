<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfJobOrEventFilter;
use Osnova\Api\Component\Model\Model;

/**
 * Class EventsFiltersResultObject
 * @package Osnova\Api\Component\Model\Custom
 */
class EventsFiltersResultObject extends Model
{
    public ArrayOfJobOrEventFilter $cities;
    public ArrayOfJobOrEventFilter $specializations;
}
