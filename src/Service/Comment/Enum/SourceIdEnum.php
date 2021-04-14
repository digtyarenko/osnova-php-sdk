<?php declare(strict_types=1);

namespace Osnova\Api\Service\Comment\Enum;

use Osnova\Api\Component\Enum\IntEnum;

/**
 * Class SourceIdEnum
 * @package Osnova\Api\Service\Comment\Enum
 */
class SourceIdEnum extends IntEnum
{
    public const SOURCE_ID_OTHER = 0;
    public const SOURCE_ID_IOS = 1;
    public const SOURCE_ID_ANDROID = 2;
}
