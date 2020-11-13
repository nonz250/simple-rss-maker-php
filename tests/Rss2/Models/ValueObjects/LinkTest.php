<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Link;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Exceptions\LinkFormatException;
use SimpleRssMaker\Shared\Exceptions\StrLengthException;
use Tests\TestHelper\StrTestHelper;

class LinkTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomUrl(Link::MAX_LENGTH);
        $link = new Link($expected);
        $this->assertInstanceOf(Link::class, $link);
        $this->assertEquals($expected, (string)$link);
        return $link;
    }

    public function testFormatException()
    {
        $this->expectException(LinkFormatException::class);
        $expected = StrTestHelper::createRandomStr();
        new Link($expected);
    }

    public function testLengthException()
    {
        $this->expectException(StrLengthException::class);
        $expected = StrTestHelper::createRandomUrl(Link::MAX_LENGTH + 1);
        new Link($expected);
    }
}
