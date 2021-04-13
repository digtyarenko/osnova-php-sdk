<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\SocialAccount;

/**
 * Class ArrayOfSocialAccount
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfSocialAccount extends ArrayOfModel
{
    public const ENTITY = SocialAccount::class;
}
