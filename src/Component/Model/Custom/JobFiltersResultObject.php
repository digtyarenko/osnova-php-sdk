<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfJobOrEventFilter;
use Osnova\Api\Component\Model\Model;

/**
 * Class JobFiltersResultObject
 * @package Osnova\Api\Component\Model\Custom
 */
class JobFiltersResultObject extends Model
{
    public ArrayOfJobOrEventFilter $area;
    public ArrayOfJobOrEventFilter $cities;
    public ArrayOfJobOrEventFilter $schedule;
    public ArrayOfJobOrEventFilter $specializations;
}
