<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class CategoryTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $category = new Category($expected);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($expected, $category);
    }
}
