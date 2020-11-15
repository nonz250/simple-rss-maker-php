<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use DateTime;
use SimpleRssMaker\Rss2\Models\Entities\Channel;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use Tests\TestHelper\StrTestHelper;

class ChannelTest extends TestCase
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
        $channel = new Channel(
            $title,
            $link,
            $description,
            $language,
            $copyright,
            $category,
            $pubDate
        );
        $this->assertInstanceOf(Channel::class, $channel);
        $this->assertEquals($title, $channel->title());
        $this->assertEquals($link, $channel->link());
        $this->assertEquals($description, $channel->description());
        $this->assertEquals($language, $channel->language());
        $this->assertEquals($copyright, $channel->copyright());
        $this->assertEquals($category, $channel->category());
        $this->assertEquals($pubDate, $channel->pubDate());
        return $channel;
    }

    /**
     * @depends test__construct
     * @param Channel $channel
     */
    public function testSetLanguage(Channel $channel)
    {
        $expected = Language::LANGUAGE_ENGLISH;
        $channel->setLanguage($expected);
        $this->assertEquals($expected, (string)$channel->language());
    }

    /**
     * @depends test__construct
     * @param Channel $channel
     */
    public function testSetCopyright(Channel $channel)
    {
        $expected = StrTestHelper::createRandomStr();
        $channel->setCopyright($expected);
        $this->assertEquals($expected, (string)$channel->copyright());
    }

    /**
     * @depends test__construct
     * @param Channel $channel
     */
    public function testSetCategory(Channel $channel)
    {
        $expected = StrTestHelper::createRandomStr();
        $channel->setCategory($expected);
        $this->assertEquals($expected, (string)$channel->category());
    }

    /**
     * @depends test__construct
     * @param Channel $channel
     */
    public function testPubDate(Channel $channel)
    {
        $expected = new DateTime();
        $channel->setPubDate($expected);
        $this->assertEquals($expected->format(DateTime::RFC822), (string)$channel->pubDate());
    }
}
