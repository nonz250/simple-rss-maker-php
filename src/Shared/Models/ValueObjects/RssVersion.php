<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\Enum;

final class RssVersion extends Enum
{
    public const VERSION_2 = '2.0';
}
