<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Component\Enum\AdditionalDataTypeEnum;

/**
 * Class AdditionalData
 * @package Osnova\Api\Component\Model
 */
class AdditionalData extends Model
{
    public AdditionalDataTypeEnum $type;
    public string $url;
    public int $size;
    public string $uuid;
    public string $duration;
    public bool $hasAudio;
}
