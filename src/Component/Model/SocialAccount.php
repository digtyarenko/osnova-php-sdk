<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class SocialAccount
 * @package Osnova\Api\Component\Model
 */
class SocialAccount extends Model
{
    public int $id;
    public int $type;
    public string $username;
    public string $url;
}
