<?php declare(strict_types=1);

namespace Osnova\Api\Service;

use Osnova\Api\Api;
use Osnova\Api\Caller;
use Osnova\Api\Common\Interfaces\IService;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\UnexpectedMethodException;
use Osnova\Api\Helper\Utils;

/**
 * @package Osnova\Api\Service
 */
class BaseService implements IService
{
    public const SERVICE = 'Base';

    protected Api $api;
    protected string $name;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $path
     * @param null $params
     * @return Caller
     * @throws InvalidParametersException
     */
    public function prepare(string $path, $params = null): Caller
    {
        $params = Utils::processParams($params);

        return $this
            ->api
            ->getCaller()
            ->prepare($path, $params);
    }

    /**
     * @param mixed ...$args
     * @return Caller
     * @throws InvalidParametersException
     */
    public function prepareWithName(...$args): Caller
    {
        if (!empty($args)) {
            $args[0] = sprintf('%s/%s', $this->getName(), trim((string) $args[0], '/'));
        }

        return $this->prepare(...$args);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        if (empty($this->name)) {
            $this->name = strtolower(static::SERVICE);
        }

        return $this->name;
    }
}
