<?php declare(strict_types=1);

namespace Osnova\Api\Service\Blacklist\Enum;

use Osnova\Api\Component\Enum\Enum;

/**
 * Class ActionEnum
 * @package Osnova\Api\Service\Blacklist\Enum
 */
class ActionEnum extends Enum
{
    public const MUTE = 'mute';
    public const UNMUTE = 'unmute';
}
