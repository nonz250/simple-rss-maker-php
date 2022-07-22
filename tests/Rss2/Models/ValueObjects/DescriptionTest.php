<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use Tests\TestHelper\StrTestHelper;

final class DescriptionTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $description = new Description($expected);
        $this->assertInstanceOf(Description::class, $description);
        $this->assertSame($expected, (string)$description);
        return $description;
    }

    public function testIsEmpty(): void
    {
        $description = new Description('');
        $this->assertTrue($description->isEmpty());
    }
}
