<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;

final class XmlVersionTest extends TestCase
{
    public function testCreateVersion1(): void
    {
        $version = new XmlVersion(XmlVersion::VERSION_1);
        $this->assertSame(XmlVersion::VERSION_1, $version->value());
        $this->assertSame(XmlVersion::VERSION_1, (string)$version);
        $this->assertSame((int)XmlVersion::VERSION_1, $version->toInt());
    }

    public function testCreateVersion1_1(): void
    {
        $version = new XmlVersion(XmlVersion::VERSION_1_1);
        $this->assertSame(XmlVersion::VERSION_1_1, $version->value());
        $this->assertSame((float)XmlVersion::VERSION_1_1, $version->toFloat());
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new XmlVersion('unknown');
    }
}
