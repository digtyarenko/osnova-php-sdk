<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Comment;

/**
 * Class ArrayOfComment
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfComment extends ArrayOfModel
{
    public const ENTITY = Comment::class;
}
