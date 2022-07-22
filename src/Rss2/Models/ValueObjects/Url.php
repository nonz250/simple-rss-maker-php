<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\ValueObjects;

use SimpleRssMaker\Foundation\Helpers\Rules\UriRule;
use SimpleRssMaker\Foundation\ValueObjects\StringBaseValue;
use SimpleRssMaker\Shared\Exceptions\LinkFormatException;
use SimpleRssMaker\Shared\Exceptions\StrLengthException;

final class Url extends StringBaseValue
{
    /**
     * Maximum character length of URLs when using IE.
     */
    public const MAX_LENGTH = 2083;

    public function __construct(string $value)
    {
        if (!UriRule::isValidHttp($value)) {
            throw new LinkFormatException(sprintf('%s must start at https:// or http://', __CLASS__));
        }

        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new StrLengthException(sprintf('%s must be less than %s chars.', __CLASS__, self::MAX_LENGTH));
        }
        $this->value = $value;
    }
}
