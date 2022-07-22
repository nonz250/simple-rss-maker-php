<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;

final class RssVersionTest extends TestCase
{
    public function testCreateVersion2(): void
    {
        $rssVersion = new RssVersion(RssVersion::VERSION_2);
        $this->assertSame(RssVersion::VERSION_2, $rssVersion->value());
        $this->assertSame(RssVersion::VERSION_2, (string)$rssVersion);
        $this->assertSame((int)RssVersion::VERSION_2, $rssVersion->toInt());
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RssVersion('unknown');
    }
}
