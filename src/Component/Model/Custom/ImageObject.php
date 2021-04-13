<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Component\Model\AttachImage;
use Osnova\Api\Component\Model\Model;

/**
 * Class ImageObject
 * @package Osnova\Api\Component\Model\Custom
 */
class ImageObject extends Model
{
    public string $type;
    public AttachImage $data;
}
