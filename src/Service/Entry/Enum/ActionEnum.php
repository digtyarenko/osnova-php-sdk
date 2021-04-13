<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class ActionEnum
 * @package Osnova\Api\Service\Entry\Enum
 */
class ActionEnum extends Enum
{
    public const SUBSCRIBE = 'subscribe';
    public const UNSUBSCRIBE = 'unsubscribe';
}
