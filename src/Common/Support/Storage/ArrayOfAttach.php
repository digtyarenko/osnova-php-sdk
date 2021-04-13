<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Attach;

/**
 * Class ArrayOfAttach
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfAttach extends ArrayOfModel
{
    public const ENTITY = Attach::class;
}
