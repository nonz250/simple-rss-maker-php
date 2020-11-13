<?php
declare(strict_types=1);

namespace SimpleRssMaker\Foundation\ValueObjects;

use InvalidArgumentException;
use ReflectionObject;

abstract class Enum
{
    private $value;

    public function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $constants = $ref->getConstants();
        if (!in_array($value, $constants, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s must be %s',
                    get_called_class(),
                    implode(' or ', $constants)
                )
            );
        }
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function toInt(): int
    {
        return (int)$this->value;
    }
}
