<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use Tests\TestHelper\StrTestHelper;

final class CopyrightTest extends TestCase
{
    public function test__construct(): void
    {
        $expected = StrTestHelper::createRandomStr();
        $copyright = new Copyright($expected);
        $this->assertInstanceOf(Copyright::class, $copyright);
        $this->assertSame($expected, (string)$copyright);
    }

    public function testIsEmpty(): void
    {
        $copyright = new Copyright('');
        $this->assertTrue($copyright->isEmpty());
    }
}
