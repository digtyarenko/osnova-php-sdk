<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Cover
 * @package Osnova\Api\Component\Model
 */
class Cover extends Model
{
    public int $type;
    public AdditionalData $additionalData;
    public string $thumbnailUrl;
    public string $url;
    public Size $size;
    public string $size_simple; // sizeSimple documented
}
