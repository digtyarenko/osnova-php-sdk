<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Company
 * @package Osnova\Api\Component\Model
 */
class Company extends Model
{
    public int $id;
    public string $name;
    public string $logo;
    public string $url;
    public bool $is_verified;
}
