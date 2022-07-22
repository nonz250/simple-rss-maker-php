<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Item;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use Tests\TestHelper\StrTestHelper;

final class ItemTest extends TestCase
{
    public function test__construct(): Item
    {
        $guid = new Url(StrTestHelper::createRandomUrl());
        $title = new Title(StrTestHelper::createRandomStr());
        $link = new Url(StrTestHelper::createRandomUrl());
        $description = null;
        $author = null;
        $category = null;
        $pubDate = null;
        $item = new Item(
            $guid,
            $title,
            $link,
            $description,
            $author,
            $category,
            $pubDate,
        );
        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame((string)$guid, (string)$item->guid());
        $this->assertSame((string)$title, (string)$item->title());
        $this->assertSame((string)$link, (string)$item->link());
        $this->assertNull($item->description());
        $this->assertNull($item->author());
        $this->assertNull($item->category());
        $this->assertNull($item->pubDate());

        return $item;
    }

    /**
     * @depends test__construct
     *
     * @param Item $item
     */
    public function testSetDescription(Item $item): void
    {
        $description = new Description(StrTestHelper::createRandomStr());
        $item->setDescription($description);
        $this->assertSame((string)$description, (string)$item->description());
    }

    /**
     * @depends test__construct
     *
     * @param Item $item
     */
    public function testSetAuthor(Item $item): void
    {
        $author = new Author(StrTestHelper::createRandomStr());
        $item->setAuthor($author);
        $this->assertSame((string)$author, (string)$item->author());
    }

    /**
     * @depends test__construct
     *
     * @param Item $item
     */
    public function testSetCategory(Item $item): void
    {
        $category = new Category(StrTestHelper::createRandomStr());
        $item->setCategory($category);
        $this->assertSame((string)$category, (string)$item->category());
    }

    /**
     * @depends test__construct
     *
     * @param Item $item
     */
    public function testSetPubFate(Item $item): void
    {
        $pubDate = new Date(new \DateTimeImmutable());
        $item->setPubDate($pubDate);
        $this->assertSame((string)$pubDate, (string)$item->pubDate());
    }
}
