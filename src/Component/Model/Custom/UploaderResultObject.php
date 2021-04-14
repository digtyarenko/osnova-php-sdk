<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Component\Model\Attach;
use Osnova\Api\Component\Model\Model;

/**
 * Class UploaderResultObject
 * @package Osnova\Api\Component\Model\Custom
 */
class UploaderResultObject extends Model
{
    public string $type;
    public Attach $data;
}
