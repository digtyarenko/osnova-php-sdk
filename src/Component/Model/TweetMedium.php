<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class TweetMedium
 * @package Osnova\Api\Component\Model
 */
class TweetMedium extends Model
{
    public int $type;
    public string $thumbnail_url;
    public string $media_url;
    public int $thumbnail_width;
    public int $thumbnail_height;
    public int $ratio;
}
