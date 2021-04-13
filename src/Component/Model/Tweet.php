<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfTweetMedium;

/**
 * Class Tweet
 * @package Osnova\Api\Component\Model
 */
class Tweet extends Model
{
    public string $id;
    public string $text;
    public TweetUser $user;
    public int $retweet_count;
    public int $favorite_count;
    public int $has_media;
    public ArrayOfTweetMedium $media;
    public int $created_at;
}
