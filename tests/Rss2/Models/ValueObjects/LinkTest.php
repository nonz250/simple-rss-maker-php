<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Exceptions\LinkFormatException;
use SimpleRssMaker\Shared\Exceptions\StrLengthException;
use Tests\TestHelper\StrTestHelper;

class LinkTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomUrl(Url::MAX_LENGTH);
        $link = new Url($expected);
        $this->assertInstanceOf(Url::class, $link);
        $this->assertEquals($expected, (string)$link);
        return $link;
    }

    public function testFormatException()
    {
        $this->expectException(LinkFormatException::class);
        $expected = StrTestHelper::createRandomStr();
        new Url($expected);
    }

    public function testLengthException()
    {
        $this->expectException(StrLengthException::class);
        $expected = StrTestHelper::createRandomUrl(Url::MAX_LENGTH + 1);
        new Url($expected);
    }
}
