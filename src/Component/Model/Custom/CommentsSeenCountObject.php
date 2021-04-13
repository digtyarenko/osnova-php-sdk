<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Component\Model\Model;

/**
 * Class CommentsSeenCountObject
 * @package Osnova\Api\Component\Model\Custom
 */
class CommentsSeenCountObject extends Model
{
    public int $count;
    public int $date;
}
