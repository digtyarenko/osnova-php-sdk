<?php declare(strict_types=1);

namespace Osnova\Api\Service\Subsite\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class SortingEnum
 * @package Osnova\Api\Service\Subsite\Enum
 */
class SortingEnum extends Enum
{
    public const NONE = '';
    public const SNEW = 'new';
    public const TOP_WEEK = 'top/week';
    public const TOP_MONTH = 'top/month';
    public const TOP_YEAR = 'top/year';
    public const TOP_ALL = 'top/all';
}
