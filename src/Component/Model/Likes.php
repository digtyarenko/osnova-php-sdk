<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Likes
 * @package Osnova\Api\Component\Model
 */
class Likes extends Model
{
    public int $count;
    public int $summ;
    public int $is_liked;
    public int $is_hidden;
}
