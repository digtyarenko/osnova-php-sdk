<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model\Custom;

use Osnova\Api\Common\Support\Storage\ArrayOfEvent;
use Osnova\Api\Component\Model\Model;

/**
 * Class EventsResultObject
 * @package Osnova\Api\Component\Model\Custom
 */
class EventsResultObject extends Model
{
    public ArrayOfEvent $items;
    public int $last_id;
}
