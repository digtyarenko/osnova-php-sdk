<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Component\Model\Custom\ImageObject;

/**
 * Class Attach
 * @package Osnova\Api\Component\Model
 */
class Attach extends Model
{
    public string $id;
    public string $uuid;
    public string $additionalData;
    public string $type;
    public string $color;
    public int $width;
    public int $height;
    public int $size;
    public string $name;
    public string $origin;
    public string $title;
    public string $description;
    public string $url;
    public ImageObject $image;
}
