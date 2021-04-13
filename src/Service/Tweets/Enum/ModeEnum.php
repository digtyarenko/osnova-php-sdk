<?php declare(strict_types=1);

namespace Osnova\Api\Service\Tweets\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class ModeEnum
 * @package Osnova\Api\Service\Tweets\Enum
 */
class ModeEnum extends Enum
{
    public const FRESH = 'fresh';
    public const DAY = 'day';
    public const WEEK = 'week';
    public const MONTH = 'month';
}
