<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry\Enum;

use Osnova\Api\Component\Enum\IntEnum;

/**
 * Class EntryTypeEnum
 * @package Osnova\Api\Service\Entry\Enum
 */
class EntryTypeEnum extends IntEnum
{
    public const TYPE_ENTRY = 1;
    public const TYPE_VACANCY = 2;
    public const TYPE_STATICPAGE = 3;
    public const TYPE_EVENT = 4;
    public const TYPE_REPOST = 5;
}
