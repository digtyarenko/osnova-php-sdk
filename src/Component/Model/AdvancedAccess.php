<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class AdvancedAccess
 * @package Osnova\Api\Component\Model
 */
class AdvancedAccess extends Model
{
    public bool $is_needs_advanced_access;
    public AdvancedAccessActions $actions;
    public Subscription $dtf_subscription;
    public Subscription $tv_subscription;
    public Subscription $vc_subscription;
    public string $hash;
}
