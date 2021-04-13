<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Counters
 * @package Osnova\Api\Component\Model
 */
class Counters extends Model
{
    public int $entries;
    public int $comments;
    public int $favorites;
}
