<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use DateTime;
use DOMDocument;
use SimpleRssMaker\Rss2\Models\Entities\Rss2;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use SimpleRssMaker\Rss2\Models\Factories\ImageFactory;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use Tests\TestHelper\StrTestHelper;

class Rss2Test extends TestCase
{
    private XmlVersion $xmlVersion;
    private XmlEncoding $xmlEncoding;
    private RssVersion $rssVersion;

    protected function setUp(): void
    {
        parent::setUp();
        $this->xmlVersion = new XmlVersion(XmlVersion::VERSION_1);
        $this->xmlEncoding = new XmlEncoding(XmlEncoding::UTF8);
        $this->rssVersion = new RssVersion(RssVersion::VERSION_2);
    }

    public function testRequireValues()
    {
        $factory = new ChannelFactory();
        $channel = $factory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );

        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $this->assertInstanceOf(Rss2::class, $rss2);

        $dom = new DOMDocument();
        $dom->loadXML((string)$rss2);

        $channel = $dom->getElementsByTagName('channel');
        $this->assertCount(1, $channel);

        $title = $dom->getElementsByTagName('title');
        $this->assertCount(1, $title);

        $link = $dom->getElementsByTagName('link');
        $this->assertCount(1, $link);

        $description = $dom->getElementsByTagName('description');
        $this->assertCount(1, $description);

        $language = $dom->getElementsByTagName('language');
        $this->assertCount(1, $language);

        $copyright = $dom->getElementsByTagName('copyright');
        $this->assertCount(0, $copyright);

        $category = $dom->getElementsByTagName('category');
        $this->assertCount(0, $category);

        $pubDate = $dom->getElementsByTagName('pubDate');
        $this->assertCount(0, $pubDate);

        $image = $dom->getElementsByTagName('image');
        $this->assertCount(0, $image);

        return $rss2;
    }

    public function testCopyrightValue()
    {
        $factory = new ChannelFactory();
        $channel = $factory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );

        $channel->setCopyright(new Copyright(StrTestHelper::createRandomStr()));

        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $this->assertInstanceOf(Rss2::class, $rss2);

        $dom = new DOMDocument();
        $dom->loadXML((string)$rss2);

        $copyright = $dom->getElementsByTagName('copyright');
        $this->assertCount(1, $copyright);
    }

    public function testCategoryValue()
    {
        $factory = new ChannelFactory();
        $channel = $factory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );

        $channel->setCategory(new Category(StrTestHelper::createRandomStr()));

        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $this->assertInstanceOf(Rss2::class, $rss2);

        $dom = new DOMDocument();
        $dom->loadXML((string)$rss2);

        $category = $dom->getElementsByTagName('category');
        $this->assertCount(1, $category);
    }

    public function testPubDateValue()
    {
        $factory = new ChannelFactory();
        $channel = $factory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );

        $channel->setPubDate(new Date(new DateTime()));

        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $this->assertInstanceOf(Rss2::class, $rss2);

        $dom = new DOMDocument();
        $dom->loadXML((string)$rss2);

        $pubDate = $dom->getElementsByTagName('pubDate');
        $this->assertCount(1, $pubDate);
    }

    public function testImageTags()
    {
        $channelFactory = new ChannelFactory();
        $channel = $channelFactory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );

        $imageFactory = new ImageFactory();
        $image = $imageFactory->newImage(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomUrl(),
        );

        $channel->setImage($image);

        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $this->assertInstanceOf(Rss2::class, $rss2);

        $dom = new DOMDocument();
        $dom->loadXML((string)$rss2);

        $image = $dom->getElementsByTagName('image');
        $this->assertCount(1, $image);

        $title = $dom->getElementsByTagName('title');
        $this->assertCount(2, $title);

        $link = $dom->getElementsByTagName('link');
        $this->assertCount(2, $link);

        $url = $dom->getElementsByTagName('url');
        $this->assertCount(1, $url);
    }
}
