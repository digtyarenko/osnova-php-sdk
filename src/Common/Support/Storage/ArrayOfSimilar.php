<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Similar;

/**
 * Class ArrayOfSimilar
 * @package Osnova\Api\Model\Storage
 */
class ArrayOfSimilar extends ArrayOfModel
{
    public const ENTITY = Similar::class;
}
