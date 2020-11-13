<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class TitleTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $title = new Title($expected);
        $this->assertInstanceOf(Title::class, $title);
        $this->assertEquals($expected, (string)$title);
        return $title;
    }

    public function testIsEmpty()
    {
        $title = new Title('');
        $this->assertTrue($title->isEmpty());
    }
}
