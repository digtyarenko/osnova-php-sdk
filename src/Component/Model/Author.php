<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfSocialAccount;

/**
 * Class Author
 * @package Osnova\Api\Component\Model
 */
class Author extends Model
{
    public int $id;
    public int $created;
    public string $first_name;
    public string $last_name;
    public string $name;
    public int $gender;
    public string $url;
    public string $avatar_url;
    public int $karma;
    public ArrayOfSocialAccount $social_accounts;
}
