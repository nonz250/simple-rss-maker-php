<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use DateTime;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Item;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use Tests\TestHelper\StrTestHelper;

class ItemTest extends TestCase
{
    public function test__construct()
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
        $this->assertEquals($guid, (string)$item->guid());
        $this->assertEquals($title, (string)$item->title());
        $this->assertEquals($link, (string)$item->link());
        $this->assertNull($item->description());
        $this->assertNull($item->author());
        $this->assertNull($item->category());
        $this->assertNull($item->pubDate());

        return $item;
    }

    /**
     * @depends test__construct
     * @param Item $item
     */
    public function testSetDescription(Item $item)
    {
        $description = new Description(StrTestHelper::createRandomStr());
        $item->setDescription($description);
        $this->assertEquals((string)$description, (string)$item->description());
    }

    /**
     * @depends test__construct
     * @param Item $item
     */
    public function testSetAuthor(Item $item)
    {
        $author = new Author(StrTestHelper::createRandomStr());
        $item->setAuthor($author);
        $this->assertEquals((string)$author, (string)$item->author());
    }

    /**
     * @depends test__construct
     * @param Item $item
     */
    public function testSetCategory(Item $item)
    {
        $category = new Category(StrTestHelper::createRandomStr());
        $item->setCategory($category);
        $this->assertEquals((string)$category, (string)$item->category());
    }

    /**
     * @depends test__construct
     * @param Item $item
     */
    public function testSetPubFate(Item $item)
    {
        $pubDate = new Date(new DateTime());
        $item->setPubDate($pubDate);
        $this->assertEquals((string)$pubDate, (string)$item->pubDate());
    }
}
