<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Common\Support\Storage\ArrayOfSocialAccount;

/**
 * Class Contacts
 * @package Osnova\Api\Model
 */
class Contacts extends Model
{
    public ArrayOfSocialAccount $socials;
    public \stdClass $site;
    public string $email;
    public string $contacts;
}
