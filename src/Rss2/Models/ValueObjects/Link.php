<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\ValueObjects;

use SimpleRssMaker\Foundation\Helpers\Rules\UriRule;
use SimpleRssMaker\Shared\Exceptions\LinkFormatException;
use SimpleRssMaker\Shared\Exceptions\StrLengthException;

final class Link
{
    /**
     * Maximum character length of URLs when using IE
     */
    public const MAX_LENGTH = 2083;

    private string $link;

    public function __construct(string $link)
    {
        if (!UriRule::isValidHttp($link)) {
            throw new LinkFormatException(sprintf('%s must start at https:// or http://', get_class()));
        }
        if (mb_strlen($link) > self::MAX_LENGTH) {
            throw new StrLengthException(sprintf('%s must be less than %s chars.', get_class(), self::MAX_LENGTH));
        }
        $this->link = $link;
    }

    public function __toString(): string
    {
        return (string)$this->link;
    }
}
