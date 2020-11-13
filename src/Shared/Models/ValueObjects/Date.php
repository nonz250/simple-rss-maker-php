<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use DateTime;
use DateTimeInterface;

final class Date
{
    private DateTimeInterface $value;

    public function __construct(DateTimeInterface $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value->format(DateTime::RFC822);
    }
}
