<?php declare(strict_types=1);

namespace Osnova\Api\Component\Enum;

use Osnova\Api\Exception\EnumException;

/**
 * Class Enum
 * @package Osnova\Api\Component\Enum
 */
abstract class Enum
{
    private string $currentValue;

    /**
     * @param string $value
     * @throws EnumException
     */
    public function __construct(string $value)
    {
        $this->checkIsValueExists($value);
        $this->currentValue = $value;
    }

    public function __toString()
    {
        return $this->currentValue;
    }

    /**
     * @param string $value
     * @throws EnumException
     */
    protected function checkIsValueExists(string $value): void
    {
        $constants = (new \ReflectionObject($this))->getConstants();

        if (!in_array($value, array_values($constants))) {
            throw new EnumException("Value '{$value}' not found in " . get_class($this));
        }
    }
}
