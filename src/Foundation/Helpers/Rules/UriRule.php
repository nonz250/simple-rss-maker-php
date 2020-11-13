<?php
declare(strict_types=1);

namespace SimpleRssMaker\Foundation\Helpers\Rules;

class UriRule
{
    public static function isValidUrlScheme(string $value): bool
    {
        // FIXME: It's in a blacklist format. Not everything written here is a banned string of characters.
        if (preg_match('@^((ssh|ftp|gopher|)://|(mailto|tel|sms|news|telnet):)@', $value)) {
            // Failure if it starts with a specific protocol
            return false;
        }
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    public static function isValidHttp(string $value): bool
    {
        // Do a base URL scheme check and then do a https or http check.
        return self::isValidUrlScheme($value) && preg_match('@^https?+://@', $value);
    }

    public static function isValidHttps(string $value): bool
    {
        // Do a base URL scheme check, and then do an http check.
        return self::isValidUrlScheme($value) && preg_match('@^https://@', $value);
    }
}
