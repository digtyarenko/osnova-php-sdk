<?php declare(strict_types=1);

namespace Osnova\Api\Service\User\Enum;

use Osnova\Api\Component\Enum\IntEnum;

/**
 * Class NotificationTypeEnum
 * @package Osnova\Api\Service\User\Enum
 */
class NotificationTypeEnum extends IntEnum
{
    public const TYPE_LIKE = 2;
    public const TYPE_REPLY = 4;
    public const TYPE_BANNED = 8;
    public const TYPE_UNPUBLISH = 16;
    public const TYPE_COMMENT = 32;
    public const TYPE_SYSTEM = 64;
    public const TYPE_VACANCY = 128;
}
