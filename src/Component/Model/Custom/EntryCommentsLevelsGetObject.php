<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfComment;
use Osnova\Api\Component\Model\CommentsLoadMore;
use Osnova\Api\Component\Model\Model;

/**
 * Class EntryCommentsLevelsGetObject
 * @package Osnova\Api\Component\Model\Custom
 */
class EntryCommentsLevelsGetObject extends Model
{
    public ArrayOfComment $items;
    public CommentsLoadMore $root_load_more;
}
