<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Watcher
 * @package Osnova\Api\Component\Model
 */
class Watcher extends Model
{
    public int $id;
    public string $event;
    public string $url;
}
