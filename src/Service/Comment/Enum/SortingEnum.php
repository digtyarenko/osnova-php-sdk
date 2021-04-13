<?php declare(strict_types=1);

namespace Osnova\Api\Service\Comment\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class SortingEnum
 * @package Osnova\Api\Service\Comment\Enum
 */
class SortingEnum extends Enum
{
    public const RECENT = 'recent';
    public const POPULAR = 'popular';
    public const DATE = 'date';
}
