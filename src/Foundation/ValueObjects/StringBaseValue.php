<?php
declare(strict_types=1);

namespace SimpleRssMaker\Foundation\ValueObjects;

abstract class StringBaseValue
{
    protected string $value;

    public function __toString(): string
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return $this->value === '';
    }
}
