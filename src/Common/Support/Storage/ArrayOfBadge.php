<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Badge;

/**
 * Class ArrayOfBadge
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfBadge extends ArrayOfModel
{
    public const ENTITY = Badge::class;
}
