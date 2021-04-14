<?php declare(strict_types=1);

namespace Osnova\Api\Service;

use Osnova\Api\Api;
use Osnova\Api\Common\Interfaces\IService;

/**
 * Class ServiceFactory
 * @package Osnova\Api\Service
 */
class ServiceFactory
{
    /**
     * @param string $serviceName
     * @param Api $api
     * @return IService
     * @throws \Exception
     */
    public static function getService(string $serviceName, Api $api): IService
    {
        if (!is_subclass_of($serviceName, BaseService::class)) {
            throw new \Exception('Service must be subclass of ' . BaseService::class);
        }

        return new $serviceName($api);
    }
}
