<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

use DateTime;
use JsonSerializable;
use ReflectionClass;

abstract class AbstractDTO implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        $reflectionChildClass = new ReflectionClass($this);
        $properties = $reflectionChildClass->getProperties();

        $json = [];
        foreach ($properties as $property) {
            if ($property->isInitialized($this)) {
                $json[$property->getName()] = $property->getValue($this);
            }
        }

        return $json;
    }

    public function toArray(): array
    {
        return $this->jsonSerialize();
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    /**
     * @throws \ReflectionException
     */
    public static function fromArray(array $data): static
    {
        $child = static::class;
        $reflectionChildClass = new ReflectionClass($child);

        $args = [];
        foreach ($reflectionChildClass->getProperties() as $property) {
            if ($val = $data[$property->getName()]) {
                if ($property->getType()->getName() == 'DateTime' && !$val instanceof \DateTime) {
                    if (is_array($val) && isset($val['date']) && isset($val['timezone'])) {
                        $val = DateTime::createFromFormat('Y-m-d H:i:s.u', $val['date'], new \DateTimeZone($val['timezone']));
                    } else {
                        $val = DateTime::createFromFormat('Y-m-d H:i:s.u', $val, new \DateTimeZone('UTC'));
                    }
                }
                $args[$property->getName()] = $val;
            }
        }

        return new $child(...$args);
    }

    /**
     * @throws \ReflectionException
     */
    public static function fromJson(string $json): static
    {
        $data = json_decode($json, true);
        return self::fromArray($data);
    }
}