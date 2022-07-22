<?php
declare(strict_types=1);

namespace Tests\TestHelper;

final class StrTestHelper
{
    private const DEFAULT_LENGTH = 256;

    private const MIN_DOMAIN_LABEL_LENGTH = 1;

    private const MAX_DOMAIN_LABEL_LENGTH = 63;

    public static function createRandomStr(
        int $length = self::DEFAULT_LENGTH,
        string $chars = '1234567890abcdefghijklmnopqrstuvwxyz'
    ): string {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mb_substr($chars, mt_rand(0, mb_strlen($chars) - 1), 1);
        }
        return $result;
    }

    public static function createRandomUrl(int $length = self::DEFAULT_LENGTH, bool $ssl = true)
    {
        $scheme = $ssl ? 'http://' : 'https://';
        $topDomain = '.test';
        $secondDomainLength = self::createRandomStr(
            mt_rand(
                self::MIN_DOMAIN_LABEL_LENGTH,
                self::MAX_DOMAIN_LABEL_LENGTH
            )
        );
        $url = $scheme . $secondDomainLength . $topDomain . DIRECTORY_SEPARATOR;
        $url .= self::createRandomStr($length - mb_strlen($url));
        return $url;
    }
}
