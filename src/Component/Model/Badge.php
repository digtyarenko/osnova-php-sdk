<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Badge
 * @package Osnova\Api\Component\Model
 */
class Badge extends Model
{
    public string $type;
    public string $text;
    public string $color;
    public string $background;
    public string $border;
}
