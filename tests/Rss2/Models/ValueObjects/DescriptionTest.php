<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class DescriptionTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $description = new Description($expected);
        $this->assertInstanceOf(Description::class, $description);
        $this->assertEquals($expected, (string)$description);
        return $description;
    }

    public function testIsEmpty()
    {
        $description = new Description('');
        $this->assertTrue($description->isEmpty());
    }
}
