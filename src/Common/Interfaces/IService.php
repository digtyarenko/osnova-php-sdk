<?php declare(strict_types=1);

namespace Osnova\Api\Common\Interfaces;

use Osnova\Api\Caller;

/**
 * Interface IService
 * @package Osnova\Api\Common\Interfaces
 */
interface IService
{
    /**
     * @param string $path
     * @param null $params
     * @return Caller
     */
    public function prepare(string $path, $params = null): Caller;

    /**
     * @param ...$args
     * @return Caller
     */
    public function prepareWithName(...$args): Caller;

    /**
     * @return string
     */
    public function getName(): string;
}
