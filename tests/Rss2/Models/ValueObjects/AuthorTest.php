<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class AuthorTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $author = new Author($expected);
        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals($expected, (string)$author);
        return $author;
    }

    public function testIsEmpty()
    {
        $author = new Author('');
        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals('', (string)$author);
        $this->assertTrue($author->isEmpty());
    }
}
