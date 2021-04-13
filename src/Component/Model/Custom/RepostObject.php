<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Component\Model\Model;
use Osnova\Api\Component\Model\Subsite;

/**
 * Class RepostObject
 * @package Osnova\Api\Component\Model\Custom
 */
class RepostObject extends Model
{
    public Subsite $author;
}
