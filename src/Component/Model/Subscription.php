<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Subscription
 * @package Osnova\Api\Component\Model
 */
class Subscription extends Model
{
    public bool $is_active;
    public int $active_until;
}
