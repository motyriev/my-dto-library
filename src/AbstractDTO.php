<?php

declare(strict_types=1);

namespace Motyriev\MyDTOLibrary;

use Carbon\Carbon;
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
                $val = $property->getValue($this);
                if ($property->getType()->getName() == 'DateTime' && $val instanceof \DateTime) {
                    $val = Carbon::parse($val)->toIso8601ZuluString();
                }
                $json[$property->getName()] = $val;
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

    public static function fromArray(array $data): static
    {
        $child = static::class;
        $reflectionChildClass = new ReflectionClass($child);

        $args = [];

        foreach ($reflectionChildClass->getProperties() as $property) {
            if ($val = $data[$property->getName()]) {
                if ($property->getType()->getName() == 'DateTime' && !$val instanceof \DateTime) {
                    try {
                        $val = Carbon::parse($val)->toDateTime();
                    } catch (\Exception $e) {
                        throw new \InvalidArgumentException('Invalid date format for property ' . $property->getName());
                    }
                }
                $args[$property->getName()] = $val;
            }
        }

        return new $child(...$args);
    }

    public static function fromJson(string $json): static
    {
        $data = json_decode($json, true);
        return self::fromArray($data);
    }
}