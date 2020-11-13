<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\StringBaseValue;

final class Title extends StringBaseValue
{
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
