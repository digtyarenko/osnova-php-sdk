<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

class Medium extends Model
{
    public const TYPE_IMAGE = 1;
    public const TYPE_VIDEO = 2;

    public int $type;
    public string $imageUrl;
    public string $iframeUrl;
    public string $service;
    public AdditionalData $additionalData;
    public Size $size;
}
