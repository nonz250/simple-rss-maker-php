<?php
declare(strict_types=1);

namespace Tests;

use DateTime;
use DateTimeZone;
use Exception;
use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Shared\Exceptions\ChannelNotExistException;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\SimpleRssMaker;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\SimpleRssMakerInterface;
use Tests\TestHelper\StrTestHelper;

class SimpleRssMakerTest extends TestCase
{
    public function test__construct()
    {
        $simpleRSSMaker = new SimpleRssMaker(XmlEncoding::UTF8);
        $this->assertInstanceOf(SimpleRssMaker::class, $simpleRSSMaker);
        return $simpleRSSMaker;
    }

    /**
     * @depends test__construct
     * @param SimpleRssMakerInterface $simpleRSSMaker
     */
    public function testException(SimpleRssMakerInterface $simpleRSSMaker)
    {
        $this->expectException(ChannelNotExistException::class);
        $simpleRSSMaker->rss2();
    }

    /**
     * @depends test__construct
     * @param SimpleRssMakerInterface $simpleRSSMaker
     */
    public function testChannelFactory(SimpleRssMakerInterface $simpleRSSMaker)
    {
        $channel = $simpleRSSMaker->channelFactory(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );
        $this->assertInstanceOf(Channel::class, $channel);
        $simpleRSSMaker->setChannel($channel);
        $this->assertIsString($simpleRSSMaker->rss2());
    }

    /**
     * @depends test__construct
     * @param SimpleRssMakerInterface $simpleRSSMaker
     * @throws Exception
     */
    public function testRss2(SimpleRssMakerInterface $simpleRSSMaker)
    {
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $description = StrTestHelper::createRandomStr();
        $copyright = StrTestHelper::createRandomStr();
        $pubDate = new DateTime('now', new DateTimeZone('UTC'));
        $category = StrTestHelper::createRandomStr();

        $channel = $simpleRSSMaker
            ->channelFactory($title, $link, $description);

        $channel->setCopyright($copyright);
        $channel->setPubDate($pubDate);
        $channel->setCategory($category);

        $rss2 = $simpleRSSMaker
            ->setChannel($channel)
            ->rss2();
        $expected = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>{$title}</title>
    <link>{$link}</link>
    <description>{$description}</description>
    <language>ja</language>
    <copyright>{$copyright}</copyright>
    <pubDate>{$pubDate->format(DateTime::RFC822)}</pubDate>
    <category>{$category}</category>
  </channel>
</rss>

XML;
        $this->assertEquals((string)$expected, (string)$rss2);
    }
}
