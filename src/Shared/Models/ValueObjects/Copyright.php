<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\StringBaseValue;

final class Copyright extends StringBaseValue
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
