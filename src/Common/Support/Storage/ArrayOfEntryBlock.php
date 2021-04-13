<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\EntryBlock;

/**
 * Class ArrayOfEntryBlock
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfEntryBlock extends ArrayOfModel
{
    public const ENTITY = EntryBlock::class;
}
