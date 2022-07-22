<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\ValueObjects;

use SimpleRssMaker\Foundation\ValueObjects\Enum;

final class Language extends Enum
{
    public const LANGUAGE_JAPANESE = 'ja';

    public const LANGUAGE_ENGLISH = 'en';

    public const LANGUAGE_ENGLISH_US = 'en-US';
}
