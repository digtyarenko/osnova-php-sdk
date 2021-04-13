<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfSocialAccount;

/**
 * Class Subsite
 * @package Osnova\Api\Component\Model
 */
class Subsite extends Model
{
    public int $id;
    public string $url;
    public int $type;
    public string $name;
    public string $description;
    public string $avatar_url;
    public SubsiteCover $cover;
    public bool $is_subscribed;
    public bool $is_verified;
    public bool $is_unsubscribable;
    public int $subscribers_count;
    public int $comments_count;
    public int $entries_count;
    public int $vacancies_count;
    public int $created;
    public string $createdRFC;
    public int $karma;
    public ArrayOfSocialAccount $social_accounts;
    public string $push_topic;
    public AdvancedAccess $advanced_access;
    public Counters $counters;
    public string $user_hash;
    public \stdClass $contacts;
}
