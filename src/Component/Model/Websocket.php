<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Component\Enum\WebsocketTypeEnum;

/**
 * Class Websocket
 * @package Osnova\Api\Component\Model
 */
class Websocket extends Model
{
    public WebsocketTypeEnum $type;
    public int $content_id;
    public int $count;
    public int $id;
    public int $state;
    public string $user_hash;
}
