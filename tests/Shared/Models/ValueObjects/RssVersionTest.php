<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;
use PHPUnit\Framework\TestCase;

class RssVersionTest extends TestCase
{
    public function testCreateVersion2()
    {
        $rssVersion = new RssVersion(RssVersion::VERSION_2);
        $this->assertEquals(RssVersion::VERSION_2, $rssVersion->value());
        $this->assertEquals(RssVersion::VERSION_2, (string)$rssVersion);
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        new RssVersion('unknown');
    }
}
