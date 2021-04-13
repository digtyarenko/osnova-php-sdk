<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfBadge;
use Osnova\Api\Common\Support\Storage\ArrayOfComment;
use Osnova\Api\Common\Support\Storage\ArrayOfEntryBlock;
use Osnova\Api\Common\Support\Storage\ArrayOfSimilar;
use Osnova\Api\Component\Model\Custom\CommentsSeenCountObject;
use Osnova\Api\Component\Model\Custom\RepostObject;

/**
 * Class Entry
 * @package Osnova\Api\Component\Model
 */
class Entry extends Model
{
    public const TYPE_ENTRY = 1;
    public const TYPE_VACANCY = 2;
    public const TYPE_STATICPAGE = 3;
    public const TYPE_EVENT = 4;
    public const TYPE_REPOST = 5;

    public int $id;
    public string $title;
    public string $webviewUrl;
    public EntryContent $entryContent;
    public int $date;
    public string $dateRFC;
    public int $lastModificationDate;
    public Author $author;
    public int $type;
    public string $intro;
    public Cover $cover;
    public string $introInFeed;
    public ArrayOfSimilar $similar;
    public int $hitsCount;
    public Likes $likes;
    public ArrayOfComment $commentsPreview;
    public int $commentsCount;
    public int $favoritesCount;
    public bool $isFavorited;
    public bool $isEnabledLikes;
    public bool $isEnabledComments;
    public bool $isEditorial;
    public bool $isPinned;
    public string $audioUrl;
    public ArrayOfBadge $badges;
    public array $commentatorsAvatars;
    public Subsite $subsite;
    public float $hotness;
    public int $subscribedToTreads;
    public ArrayOfEntryBlock $blocks;
    public bool $canEdit;
    public int $date_favorite;
    public int $isRepost;
    public int $is_promoted;
    public RepostObject $repost;
    public CommentsSeenCountObject $commentsSeenCount;
    public EtcControls $etcControls;
    public bool $is_show_thanks;
    public bool $is_still_updating;
    public bool $is_filled_by_editors;
    public Subsite $co_author;
}
