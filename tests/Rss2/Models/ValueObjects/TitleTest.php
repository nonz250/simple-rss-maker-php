<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use Tests\TestHelper\StrTestHelper;

final class TitleTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $title = new Title($expected);
        $this->assertInstanceOf(Title::class, $title);
        $this->assertSame($expected, (string)$title);
        return $title;
    }

    public function testIsEmpty(): void
    {
        $title = new Title('');
        $this->assertTrue($title->isEmpty());
    }
}
