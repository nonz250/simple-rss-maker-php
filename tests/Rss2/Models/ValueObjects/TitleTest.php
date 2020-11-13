<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function test__construct()
    {
        $expected = 'title';
        $title = new Title($expected);
        $this->assertInstanceOf(Title::class, $title);
        $this->assertEquals($expected, (string)$title);
        return $title;
    }
}
