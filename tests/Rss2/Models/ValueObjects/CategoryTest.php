<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use Tests\TestHelper\StrTestHelper;

final class CategoryTest extends TestCase
{
    public function test__construct(): void
    {
        $expected = StrTestHelper::createRandomStr();
        $category = new Category($expected);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertSame($expected, (string)$category);
    }

    public function testIsEmpty(): void
    {
        $category = new Category('');
        $this->assertTrue($category->isEmpty());
    }
}
