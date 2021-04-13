<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Subsite;

/**
 * Class ArrayOfSubsite
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfSubsite extends ArrayOfModel
{
    public const ENTITY = Subsite::class;
}
