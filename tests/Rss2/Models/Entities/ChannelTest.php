<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use DateTime;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Rss2\Models\Factories\ImageFactory;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\Entities\Item;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use Tests\TestHelper\StrTestHelper;

final class ChannelTest extends TestCase
{
    public function test__construct()
    {
        $title = new Title(StrTestHelper::createRandomStr());
        $link = new Url(StrTestHelper::createRandomUrl());
        $description = new Description(StrTestHelper::createRandomStr());
        $language = new Language(Language::LANGUAGE_JAPANESE);
        $copyright = new Copyright(StrTestHelper::createRandomStr());
        $category = new Category(StrTestHelper::createRandomStr());
        $pubDate = null;
        $image = null;
        $items = new ItemCollection();
        $channel = new Channel(
            $title,
            $link,
            $description,
            $language,
            $copyright,
            $category,
            $pubDate,
            $image,
            $items
        );
        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertSame($title, $channel->title());
        $this->assertSame($link, $channel->link());
        $this->assertSame($description, $channel->description());
        $this->assertSame($language, $channel->language());
        $this->assertSame($copyright, $channel->copyright());
        $this->assertSame($category, $channel->category());
        $this->assertSame($pubDate, $channel->pubDate());
        $this->assertSame($image, $channel->image());
        return $channel;
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testSetLanguage(Channel $channel): void
    {
        $expected = Language::LANGUAGE_ENGLISH;
        $channel->setLanguage(new Language($expected));
        $this->assertSame($expected, (string)$channel->language());
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testSetCopyright(Channel $channel): void
    {
        $expected = StrTestHelper::createRandomStr();
        $channel->setCopyright(new Copyright($expected));
        $this->assertSame($expected, (string)$channel->copyright());
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testSetCategory(Channel $channel): void
    {
        $expected = StrTestHelper::createRandomStr();
        $channel->setCategory(new Category($expected));
        $this->assertSame($expected, (string)$channel->category());
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testPubDate(Channel $channel): void
    {
        $expected = new \DateTimeImmutable();
        $channel->setPubDate(new Date($expected));
        $this->assertSame($expected->format(DateTime::RFC822), (string)$channel->pubDate());
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testImage(Channel $channel): void
    {
        $expected = (new ImageFactory())->newImage(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomUrl(),
        );
        $channel->setImage($expected);
        $this->assertSame((string)$expected->title(), (string)$channel->image()->title());
        $this->assertSame((string)$expected->link(), (string)$channel->image()->link());
        $this->assertSame((string)$expected->url(), (string)$channel->image()->url());
    }

    /**
     * @depends test__construct
     *
     * @param Channel $channel
     */
    public function testItemCollection(Channel $channel): void
    {
        $url = StrTestHelper::createRandomUrl();
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $expected = new ItemCollection([
            new Item(
                new Url($url),
                new Title($title),
                new Url($link),
                null,
                null,
                null,
                null,
            ),
        ]);
        $this->assertCount(0, $channel->itemCollection());
        $channel->setItemCollection($expected);
        $this->assertCount(1, $channel->itemCollection());
    }
}
