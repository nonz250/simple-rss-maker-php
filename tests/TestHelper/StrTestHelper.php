<?php
declare(strict_types=1);

namespace Tests\TestHelper;

final class StrTestHelper
{
    private const MAX_DOMAIN_LABEL_LENGTH = 63;

    public static function createRandomStr(
        int $length = 256,
        string $chars = '1234567890abcdefghijklmnopqrstuvwxyz'
    ): string {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mb_substr($chars, mt_rand(0, mb_strlen($chars) - 1), 1);
        }
        return $result;
    }

    public static function createRandomUrl(int $length = 50, bool $ssl = true)
    {
        $scheme = $ssl ? 'http://' : 'https://';
        $topDomain = '.test';
        $secondDomainLength = self::createRandomStr(mt_rand(1, self::MAX_DOMAIN_LABEL_LENGTH));
        $url = $scheme . $secondDomainLength . $topDomain . DIRECTORY_SEPARATOR;
        $url .= self::createRandomStr($length - mb_strlen($url));
        return $url;
    }
}
