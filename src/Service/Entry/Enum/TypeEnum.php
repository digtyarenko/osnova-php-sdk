<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry\Enum;

use Osnova\Api\Component\Enum\IntEnum;

/**
 * Class TypeEnum
 * @package Osnova\Api\Service\Entry\Enum
 */
class TypeEnum extends IntEnum
{
    public const ENTRY = 1;
    public const COMMENT = 2;
}
