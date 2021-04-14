<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Model;
use Osnova\Api\Helper\Utils;

/**
 * Class ArrayOfModel
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfModel extends ArrayOf
{
    public const ENTITY = Model::class;
}
