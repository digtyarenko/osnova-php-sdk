<?php declare(strict_types=1);

namespace Osnova\Api;

use Osnova\Api\Common\Config;
use Osnova\Api\Common\Interfaces\IService;
use Osnova\Api\Service\ServiceFactory;

/**
 * Class Api
 * @package Osnova\Api
 */
class Api
{
    public const VERSION = '1.8';

    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return Caller
     */
    public function getCaller(): Caller
    {
        return new Caller($this);
    }

    /**
     * @param string $serviceName
     * @return IService
     * @throws \Exception
     */
    public function getService(string $serviceName): IService
    {
        return ServiceFactory::getService($serviceName, $this);
    }
}
