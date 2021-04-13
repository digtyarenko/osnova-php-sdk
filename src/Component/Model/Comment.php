<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfAttach;
use Osnova\Api\Common\Support\Storage\ArrayOfMedium;

/**
 * Class Comment
 * @package Osnova\Api\Component\Model
 */
class Comment extends Model
{
    public const SOURCE_ID_OTHER = 0;
    public const SOURCE_ID_IOS = 1;
    public const SOURCE_ID_ANDROID = 2;

    public int $id;
    public int $date;
    public string $dateRFC;
    public Author $author;
    public string $text;
    public string $text_wo_md;
    public ArrayOfMedium $media;
    public Likes $likes;
    public Entry $entry;
    public int $replyTo;
    public bool $isFavorited;
    public bool $is_pinned;
    public bool $isEdited;
    public int $level;
    public int $source_id;
    public CommentsLoadMore $load_more;
    public ArrayOfAttach $attaches;
    public EtcControls $etcControls;
}
