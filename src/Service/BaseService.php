<?php declare(strict_types=1);

namespace Osnova\Api\Service;

use Osnova\Api\Api;
use Osnova\Api\Caller;
use Osnova\Api\Common\Interfaces\IService;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Helper\Utils;

/**
 * Class BaseService
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
     */
    public function prepare(string $path, $params = null): Caller
    {
        try {
            $params = Utils::processParams($params);
        } catch (InvalidParametersException $e) {
            $params = [];
        }

        return $this
            ->api
            ->getCaller()
            ->prepare($path, $params);
    }

    /**
     * @param int|string|null $path
     * @param null $params
     * @return Caller
     */
    public function prepareWithName($path = null, $params = null): Caller
    {
        $path = trim(sprintf('%s/%s', $this->getName(), trim((string) $path, '/')), '/');
        return $this->prepare($path, $params);
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
