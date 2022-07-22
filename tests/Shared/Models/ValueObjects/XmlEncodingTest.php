<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;

final class XmlEncodingTest extends TestCase
{
    public function testCreateUtf8(): void
    {
        $encoding = new XmlEncoding(XmlEncoding::UTF8);
        $this->assertSame(XmlEncoding::UTF8, $encoding->value());
        $this->assertSame(XmlEncoding::UTF8, (string)$encoding);
    }

    public function testCreateUtf16(): void
    {
        $encoding = new XmlEncoding(XmlEncoding::UTF16);
        $this->assertSame(XmlEncoding::UTF16, $encoding->value());
        $this->assertSame(XmlEncoding::UTF16, (string)$encoding);
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new XmlEncoding('unknown');
    }
}
