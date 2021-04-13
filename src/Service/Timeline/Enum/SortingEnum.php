<?php declare(strict_types=1);

namespace Osnova\Api\Service\Timeline\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class SortingEnum
 * @package Osnova\Api\Service\Timeline\Enum
 */
class SortingEnum extends Enum
{
    public const RECENT = 'recent';
    public const POPULAR = 'popular';
    public const WEEK = 'week';
    public const MONTH = 'month';
}
