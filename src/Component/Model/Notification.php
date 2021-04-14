<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfSubsite;
use Osnova\Api\Component\Enum\IconEnum;
use Osnova\Api\Service\User\Enum\NotificationTypeEnum;

/**
 * Class Notification
 * @package Osnova\Api\Component\Model
 */
class Notification extends Model
{
    public int $id;
    public NotificationTypeEnum $type;
    public int $date;
    public string $dateRFC;
    public ArrayOfSubsite $users;
    public string $text;
    public string $comment_text;
    public string $url;
    public IconEnum $icon;
}
