<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\TweetMedium;

/**
 * Class ArrayOfTweetMedium
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfTweetMedium extends ArrayOfModel
{
    public const ENTITY = TweetMedium::class;
}
