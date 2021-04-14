<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

use Osnova\Api\Component\Enum\Enum;
use Osnova\Api\Component\Enum\IntEnum;
use Osnova\Api\Helper\Utils;

/**
 * Class Model
 * @package Osnova\Api\Component\Model
 */
class Model
{
    private const CALL_PATTERN = '/(?<action>get|set)(?<property>[A-Z]{1}[A-Za-z]{0,})/';

    private const ACTION_GET = 'get';
    private const ACTION_SET = 'set';

    private array $propertiesMap;

    /**
     * @param string $name
     * @param array $arguments
     * @return bool|null
     * @throws \Exception
     */
    public function __call(string $name, array $arguments = [])
    {
        if (!preg_match(self::CALL_PATTERN, $name, $matches)) {
            throw new \Exception("Method '{$name}' does not exists");
        }

        $propertyName = $this->getPropertyName($matches['property']);

        switch ($matches['action']) {
            case self::ACTION_GET:
                if (!property_exists($this, $propertyName) || (0 !== $this->{$propertyName} && empty($this->{$propertyName}))) {
                    return null;
                }

                if (is_object($this->{$propertyName})) {
                    if (is_subclass_of($this->{$propertyName}, IntEnum::class)) {
                        return (int) ((string) $this->{$propertyName});
                    }

                    if (is_subclass_of($this->{$propertyName}, Enum::class)) {
                        return (string) $this->{$propertyName};
                    }
                }

                return $this->{$propertyName};
            case self::ACTION_SET:
                $this->{$propertyName} = array_shift($arguments);
                return true;
        }

        return null;
    }

    private function fillPropertiesMap(): void
    {
        if (!empty($this->propertiesMap)) {
            return;
        }

        $this->propertiesMap = [];
        $properties = (new \ReflectionObject($this))->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $this->propertiesMap[Utils::convertCaseStyle($propertyName)] = $propertyName;
        }
    }

    /**
     * @param string $property
     * @return string
     */
    private function getPropertyName(string $property): string
    {
        $property = lcfirst($property);

        if (empty($this->propertiesMap) || !array_key_exists($property, $this->propertiesMap)) {
            $this->fillPropertiesMap();
        }

        return $this->propertiesMap[$property] ?? $property;
    }
}
