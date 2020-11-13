<?php
declare(strict_types=1);

namespace SimpleRssMaker\Foundation\ValueObjects;

abstract class StringBaseValue
{
    protected string $value;

    public function isEmpty(): bool
    {
        return mb_strlen((string)$this->value) === 0;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
