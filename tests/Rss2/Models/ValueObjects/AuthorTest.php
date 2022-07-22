<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\ValueObjects;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use Tests\TestHelper\StrTestHelper;

final class AuthorTest extends TestCase
{
    public function test__construct()
    {
        $expected = StrTestHelper::createRandomStr();
        $author = new Author($expected);
        $this->assertInstanceOf(Author::class, $author);
        $this->assertSame($expected, (string)$author);
        return $author;
    }

    public function testIsEmpty(): void
    {
        $author = new Author('');
        $this->assertInstanceOf(Author::class, $author);
        $this->assertSame('', (string)$author);
        $this->assertTrue($author->isEmpty());
    }
}
