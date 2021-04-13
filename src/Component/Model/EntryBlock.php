<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class EntryBlock
 * @package Osnova\Api\Component\Model
 */
class EntryBlock extends Model
{
    public string $type;
    public \stdClass $data;
    public bool $cover;
    public string $anchor;
}
