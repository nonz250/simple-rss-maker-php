<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\Enum;

final class XmlVersion extends Enum
{
    public const VERSION_1 = '1.0';

    public const VERSION_1_1 = '1.1';
}
