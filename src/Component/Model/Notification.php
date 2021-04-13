<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfSubsite;
use Osnova\Api\Component\Enum\IconEnum;

/**
 * Class Notification
 * @package Osnova\Api\Component\Model
 */
class Notification extends Model
{
    public const TYPE_LIKE = 2;
    public const TYPE_REPLY = 4;
    public const TYPE_BANNED = 8;
    public const TYPE_UNPUBLISH = 16;
    public const TYPE_COMMENT = 32;
    public const TYPE_SYSTEM = 64;
    public const TYPE_VACANCY = 128;

    public int $id;
    public int $type;
    public int $date;
    public string $dateRFC;
    public ArrayOfSubsite $users;
    public string $text;
    public string $comment_text;
    public string $url;
    public IconEnum $icon;
}
