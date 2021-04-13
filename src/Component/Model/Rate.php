<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Rate
 * @package Osnova\Api\Component\Model
 */
class Rate extends Model
{
    public string $rate;
    public int $change;
    public string $sym;
}
