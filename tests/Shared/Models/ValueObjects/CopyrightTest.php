<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class CopyrightTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $copyright = new Copyright($expected);
        $this->assertInstanceOf(Copyright::class, $copyright);
        $this->assertEquals($expected, (string)$copyright);
    }

    public function testIsEmpty()
    {
        $copyright = new Copyright('');
        $this->assertTrue($copyright->isEmpty());
    }
}
