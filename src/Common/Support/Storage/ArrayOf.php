<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Helper\Utils;

/**
 * Class ArrayOf
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOf extends \ArrayObject
{
    public function __toString()
    {
        return json_encode(Utils::convertObjectToArray($this), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
}
