<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class CommentsLoadMore
 * @package Osnova\Api\Component\Model
 */
class CommentsLoadMore extends Model
{
    public array $ids;
    public int $count;
    public array $avatars;
}
