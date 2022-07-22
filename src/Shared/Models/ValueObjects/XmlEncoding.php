<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\Enum;

final class XmlEncoding extends Enum
{
    public const UTF8 = 'UTF-8';

    public const UTF16 = 'UTF-16';
}
