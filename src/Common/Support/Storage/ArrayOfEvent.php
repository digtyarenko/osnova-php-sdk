<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Event;

/**
 * Class ArrayOfEvent
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfEvent extends ArrayOfModel
{
    public const ENTITY = Event::class;
}
