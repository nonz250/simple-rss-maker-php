<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use PHPUnit\Framework\TestCase;

class XmlVersionTest extends TestCase
{
    public function testCreateVersion1()
    {
        $version = new XmlVersion(XmlVersion::VERSION_1);
        $this->assertEquals(XmlVersion::VERSION_1, $version->value());
        $this->assertEquals(XmlVersion::VERSION_1, (string)$version);
        $this->assertEquals((int)XmlVersion::VERSION_1, $version->toInt());
    }

    public function testCreateVersion1_1()
    {
        $version = new XmlVersion(XmlVersion::VERSION_1_1);
        $this->assertEquals(XmlVersion::VERSION_1_1, $version->value());
        $this->assertEquals((float)XmlVersion::VERSION_1_1, (string)$version->toFloat());
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        new XmlVersion('unknown');
    }
}
