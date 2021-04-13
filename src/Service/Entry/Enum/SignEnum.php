<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry\Enum;

use Osnova\Api\Component\Enum\IntEnum;

/**
 * Class SignEnum
 * @package Osnova\Api\Service\Entry\Enum
 */
class SignEnum extends IntEnum
{
    public const DOWN = -1;
    public const UP = 1;
    public const RESET = 0;
}
