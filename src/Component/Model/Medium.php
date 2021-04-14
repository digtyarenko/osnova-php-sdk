<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Component\Enum\MediumTypeEnum;

/**
 * Class Medium
 * @package Osnova\Api\Component\Model
 */
class Medium extends Model
{
    public MediumTypeEnum $type;
    public string $imageUrl;
    public string $iframeUrl;
    public string $service;
    public AdditionalData $additionalData;
    public Size $size;
}
