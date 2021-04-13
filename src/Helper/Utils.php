<?php declare(strict_types=1);

namespace Osnova\Api\Helper;

use Osnova\Api\Common\CaseStyle;
use Osnova\Api\Common\Method;
use Osnova\Api\Common\Support\Storage\ArrayOfModel;
use Osnova\Api\Component\Enum\Enum;
use Osnova\Api\Component\Enum\IntEnum;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Exception\InvalidParametersException;
use Osnova\Api\Exception\UnexpectedMethodException;
use Osnova\Api\Exception\UnexpectedTypeOfValue;

/**
 * Class Utils
 * @package Osnova\Api\Helper
 */
abstract class Utils
{
    /**
     * @param $object
     * @return array
     */
    public static function convertObjectToArray($object): array
    {
        return json_decode(json_encode($object), true);
    }

    /**
     * @param string $type
     * @param $value
     * @return array|float|int|mixed|string
     */
    public static function convertValueType(string $type, $value)
    {
        switch ($type) {
            case 'bool':
                return (bool) $value;
            case 'int':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'array':
                return (array) $value;
            case 'string':
                return (string) $value;
            default:
                return $value;
        }
    }

    /**
     * @param string $value
     * @param string $targetCaseStyle
     * @return string
     */
    public static function convertCaseStyle(string $value, string $targetCaseStyle = CaseStyle::CAMEL_CASE): string
    {
        switch ($targetCaseStyle) {
            case CaseStyle::SNAKE_CASE:
                return strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', $value), '_'));
            case CaseStyle::CAMEL_CASE:
                return lcfirst(implode('', array_map(function ($part) {
                    return ucfirst($part);
                }, explode('_', $value))));
            default:
                throw new \DomainException("Unknown case style: {$targetCaseStyle}");
        }
    }

    /**
     * @param $params
     * @return array
     * @throws InvalidParametersException
     */
    public static function processParams($params): array
    {
        $rawParams = [];

        if (empty($params)) {
            return [];
        }

        if (!is_array($params) && !is_object($params)) {
            throw new InvalidParametersException('Expected array or object with parameters, ' . gettype($params) . ' given');
        }

        if (is_array($params)) {
            $rawParams = $params;
        }

        if (is_object($params)) {
            $rawParams = get_object_vars($params);
        }

        return array_filter(array_combine(
            array_keys($rawParams),
            array_map([__CLASS__, 'processValues'], array_values($rawParams))
        ), function ($queryParam) {
            return null !== $queryParam;
        });
    }

    /**
     * @param string $method
     * @param array $params
     * @return array[]
     * @throws UnexpectedMethodException
     */
    public static function prepareParams(string $method, array $params): array
    {
        if (empty($params)) {
            return [];
        }

        switch (strtoupper($method)) {
            case Method::GET:
                return [
                    'query' => $params,
                ];
            case Method::POST:
                return [
                    'form_params' => $params,
                ];
            default:
                throw new UnexpectedMethodException("Unexpected HTTP method {$method}");
        }
    }

    /**
     * @param $value
     * @return array|string
     * @throws UnexpectedTypeOfValue
     */
    private static function processValues($value)
    {
        if (!is_object($value)) {
            return $value;
        }

        if (is_subclass_of($value, IntEnum::class)) {
            return (int) ((string) $value);
        }

        if (is_subclass_of($value, Enum::class)) {
            return (string) $value;
        }

        if (is_subclass_of($value, Model::class) || is_subclass_of($value, ArrayOfModel::class)) {
            self::convertObjectToArray($value);
        }

        throw new UnexpectedTypeOfValue('Expected string or subclass of ' . Enum::class . ', ' . get_class($value) . ' given');
    }
}
