<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Medium;

/**
 * Class ArrayOfMedium
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfMedium extends ArrayOfModel
{
    public const ENTITY = Medium::class;
}
