<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use PHPUnit\Framework\TestCase;

class XmlEncodingTest extends TestCase
{
    public function testCreateUtf8()
    {
        $encoding = new XmlEncoding(XmlEncoding::UTF8);
        $this->assertEquals(XmlEncoding::UTF8, $encoding->value());
        $this->assertEquals(XmlEncoding::UTF8, (string)$encoding);
    }

    public function testCreateUtf16()
    {
        $encoding = new XmlEncoding(XmlEncoding::UTF16);
        $this->assertEquals(XmlEncoding::UTF16, $encoding->value());
        $this->assertEquals(XmlEncoding::UTF16, (string)$encoding);
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        new XmlEncoding('unknown');
    }
}
