<?php
declare(strict_types=1);

namespace Tests\Foundation\Helpers\Rules;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Foundation\Helpers\Rules\UriRule;

final class UriRuleTest extends TestCase
{
    public function testIsValidUrlScheme(): void
    {
        $result = UriRule::isValidUrlScheme('mailto:hosaka.non.work@gmail.com');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('tel:12345');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('sms:12345');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('news://news.server.example');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('telnet://user@example.com');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('ssh://user@example.com');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('ftp://user@example.com');
        $this->assertFalse($result);
        $result = UriRule::isValidUrlScheme('gopher://user@example.com');
        $this->assertFalse($result);

        $result = UriRule::isValidUrlScheme('http://labo.nozomi.bike');
        $this->assertTrue($result);
        $result = UriRule::isValidUrlScheme('https://labo.nozomi.bike');
        $this->assertTrue($result);
    }

    public function testIsValidHttp(): void
    {
        $result = UriRule::isValidHttp('http://labo.nozomi.bike');
        $this->assertTrue($result);
        $result = UriRule::isValidHttp('https://labo.nozomi.bike');
        $this->assertTrue($result);
    }

    public function testIsValidHttps(): void
    {
        $result = UriRule::isValidHttps('http://labo.nozomi.bike');
        $this->assertFalse($result);
        $result = UriRule::isValidHttps('https://labo.nozomi.bike');
        $this->assertTrue($result);
    }
}
