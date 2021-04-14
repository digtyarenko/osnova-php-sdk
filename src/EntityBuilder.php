<?php declare(strict_types=1);

namespace Osnova\Api;

use Osnova\Api\Common\Support\Storage\ArrayOfModel;
use Osnova\Api\Component\Enum\Enum;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Exception\InvalidEntityClassException;
use Osnova\Api\Exception\OsnovaApiException;
use Osnova\Api\Helper\Utils;

/**
 * Class EntityBuilder
 * @package Osnova\Api
 */
class EntityBuilder
{
    protected const MODE_ONE_ENTITY = 1;
    protected const MODE_ARRAY_OF_ENTITIES = 2;

    protected $data;
    protected string $entityClass;
    protected int $mode;

    /**
     * @param $data
     * @param string $entityClass
     */
    public function __construct($data, string $entityClass)
    {
        $this->data = $data;
        $this->entityClass = $entityClass;

        $this->detectBuildMode();
        $this->data = Utils::convertObjectToArray($this->data);
    }

    /**
     * @return \stdClass|Model|Model[]|null
     * @throws OsnovaApiException
     */
    public function build()
    {
        switch ($this->mode) {
            case self::MODE_ONE_ENTITY:
                try {
                    return $this->buildOneEntity(
                        $this->entityClass,
                        $this->data
                    );
                } catch (InvalidEntityClassException $e) {
                    return null;
                }
            case self::MODE_ARRAY_OF_ENTITIES:
                return $this->buildArrayOfEntities(
                    $this->entityClass,
                    $this->data
                );
        }

        return null;
    }

    /**
     * @param string $entityClass
     * @param $oneEntity
     * @return Model|\stdClass|null
     * @throws InvalidEntityClassException
     * @throws OsnovaApiException
     */
    protected function buildOneEntity(string $entityClass, $oneEntity)
    {
        if (!$this->isValidEntityClass($entityClass)) {
            throw new InvalidEntityClassException("Entity '{$entityClass}' does not exists");
        }

        if (empty($oneEntity)) {
            return null;
        }

        $entity = new $entityClass;

        $reflectionProperties = $this->getReflectionData($entity);

        foreach ($reflectionProperties as $property) {
            $propertyName = $property->getName();

            if (array_key_exists($propertyName, $oneEntity)) {
                $value = $oneEntity[$propertyName];

                if (null === $value) {
                    unset($oneEntity[$propertyName]);
                    continue;
                }

                if ($property->hasType()) {
                    $propertyType = $property->getType()->getName();

                    if (class_exists($propertyType)) {
                        $this->fillProperty($entity, $propertyName, $propertyType, $value);
                        unset($oneEntity[$propertyName]);
                        continue;
                    }

                    if ($propertyType !== gettype($value)) {
                        $value = Utils::convertValueType($propertyType, $value);
                    }
                }

                $entity->{$propertyName} = $value;
                unset($oneEntity[$propertyName]);
            }
        }

        if (!empty($oneEntity)) {
            foreach ($oneEntity as $propertyKey => $propertyName) {
                $entity->{$propertyKey} = $propertyName;
            }
        }

        return $entity;
    }

    /**
     * @param string $entityClass
     * @param array $arrayOfEntities
     * @return Model[]|\stdClass[]
     * @throws OsnovaApiException
     */
    protected function buildArrayOfEntities(string $entityClass, array $arrayOfEntities): array
    {
        $result = [];

        do {
            $oneEntity = array_shift($arrayOfEntities);

            try {
                $result[] = $this->buildOneEntity($entityClass, $oneEntity);
            } catch (InvalidEntityClassException $e) {
                continue;
            }
        } while (count($arrayOfEntities));

        return array_filter($result);
    }

    /**
     * @param Model $entity
     * @param string $propertyName
     * @param string $class
     * @param $value
     * @throws OsnovaApiException
     */
    protected function fillProperty(Model $entity, string $propertyName, string $class, $value): void
    {
        switch (true) {
            case is_subclass_of($class, Model::class):
            case is_subclass_of($class, \stdClass::class):
                try {
                    $builtEntity = $this->buildOneEntity($class, $value);
                } catch (InvalidEntityClassException $e) {
                    return;
                }

                if (null === $builtEntity) {
                    return;
                }

                $entity->{$propertyName} = $builtEntity;
                break;
            case is_subclass_of($class, ArrayOfModel::class):
                $targetEntity = $class::ENTITY;
                $entity->{$propertyName} = new $class($this->buildArrayOfEntities(
                    $targetEntity,
                    $value
                ));
                break;
            case is_subclass_of($class, Enum::class):
                $entity->{$propertyName} = new $class($value);
                break;
        }
    }

    /**
     * @param Model|\stdClass $entity
     * @return \ReflectionProperty[]
     */
    protected function getReflectionData($entity): array
    {
        return (new \ReflectionObject($entity))->getProperties();
    }

    protected function detectBuildMode(): void
    {
        if (is_array($this->data)) {
            $this->mode = self::MODE_ARRAY_OF_ENTITIES;
            return;
        }

        $this->mode = self::MODE_ONE_ENTITY;
    }

    /**
     * @param string $entityClass
     * @return bool
     */
    protected function isValidEntityClass(string $entityClass): bool
    {
        return class_exists($entityClass)
            && (is_subclass_of($entityClass, Model::class)
                || \stdClass::class === $entityClass);
    }
}
