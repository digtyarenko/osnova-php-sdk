<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class TweetUser
 * @package Osnova\Api\Component\Model
 */
class TweetUser extends Model
{
    public int $created_at;
    public int $followers_count;
    public int $friends_count;
    public int $id;
    public string $name;
    public string $profile_image_url;
    public string $profile_image_url_bigger;
    public string $screen_name;
    public int $statuses_count;
}
