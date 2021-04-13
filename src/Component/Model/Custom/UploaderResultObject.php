<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfAttach;
use Osnova\Api\Component\Model\Model;

/**
 * Class UploaderResultObject
 * @package Osnova\Api\Component\Model\Custom
 */
class UploaderResultObject extends Model
{
    public string $type;
    public ArrayOfAttach $data;
}
