<?php
declare(strict_types=1);

namespace Tests;

use DateTime;
use DateTimeZone;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Shared\Exceptions\ChannelNotExistException;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\Entities\Image;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use SimpleRssMaker\SimpleRssMaker;
use SimpleRssMaker\SimpleRssMakerInterface;
use Tests\TestHelper\StrTestHelper;

final class SimpleRssMakerTest extends TestCase
{
    public function test__construct()
    {
        $simpleRssMaker = new SimpleRssMaker();
        $this->assertInstanceOf(SimpleRssMaker::class, $simpleRssMaker);
        return $simpleRssMaker;
    }

    /**
     * @depends test__construct
     *
     * @param SimpleRssMakerInterface $simpleRssMaker
     */
    public function testException(SimpleRssMakerInterface $simpleRssMaker): void
    {
        $this->expectException(ChannelNotExistException::class);
        $simpleRssMaker->rss2();
    }

    /**
     * @depends test__construct
     *
     * @param SimpleRssMakerInterface $simpleRssMaker
     *
     * @throws ReflectionException
     */
    public function testSetChannel(SimpleRssMakerInterface $simpleRssMaker): void
    {
        $simpleRssMaker->setChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );
        $ref = new ReflectionClass($simpleRssMaker);
        $prop = $ref->getProperty('channel');
        $prop->setAccessible(true);
        /** @var Channel $channel */
        $channel = $prop->getValue($simpleRssMaker);
        $this->assertInstanceOf(Channel::class, $channel);
    }

    /**
     * @depends test__construct
     *
     * @param SimpleRssMakerInterface $simpleRssMaker
     *
     * @throws ReflectionException
     */
    public function testSetImage(SimpleRssMakerInterface $simpleRssMaker): void
    {
        $simpleRssMaker->setImage(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomUrl(),
        );
        $ref = new ReflectionClass($simpleRssMaker);
        $prop = $ref->getProperty('image');
        $prop->setAccessible(true);
        /** @var Image $image */
        $image = $prop->getValue($simpleRssMaker);
        $this->assertInstanceOf(Image::class, $image);
    }

    /**
     * @depends test__construct
     *
     * @param SimpleRssMakerInterface $simpleRssMaker
     *
     * @throws ReflectionException
     */
    public function testaddItem(SimpleRssMakerInterface $simpleRssMaker): void
    {
        $simpleRssMaker->addItem(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomStr(),
        );
        $ref = new ReflectionClass($simpleRssMaker);
        $prop = $ref->getProperty('itemCollection');
        $prop->setAccessible(true);
        /** @var ItemCollection $items */
        $items = $prop->getValue($simpleRssMaker);
        $this->assertCount(1, $items);
        $simpleRssMaker->addItem(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
        );
        $this->assertCount(2, $items);
    }

    /**
     * @depends test__construct
     *
     * @param SimpleRssMakerInterface $simpleRssMaker
     *
     * @throws Exception
     */
    public function testRss2(SimpleRssMakerInterface $simpleRssMaker): void
    {
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $description = StrTestHelper::createRandomStr();
        $language = Language::LANGUAGE_JAPANESE;
        $copyright = StrTestHelper::createRandomStr();
        $pubDate = new \DateTimeImmutable('now', new DateTimeZone('UTC'));
        $category = StrTestHelper::createRandomStr();
        $imageTitle = StrTestHelper::createRandomStr();
        $imageLink = StrTestHelper::createRandomUrl();
        $imageUrl = StrTestHelper::createRandomUrl();
        $itemTitle = StrTestHelper::createRandomStr();
        $itemLink = StrTestHelper::createRandomUrl();
        $itemDescription = StrTestHelper::createRandomStr();
        $itemAuthor = StrTestHelper::createRandomStr();
        $itemCategory = StrTestHelper::createRandomStr();
        $itemDate = new \DateTimeImmutable('now', new DateTimeZone('UTC'));

        $rss2 = $simpleRssMaker
            ->setChannel($title, $link, $description, $language, $copyright, $category, $pubDate)
            ->setImage($imageTitle, $imageLink, $imageUrl)
            ->addItem($itemTitle, $itemLink, $itemDescription, $itemAuthor, $itemCategory, $itemDate)
            ->addItem($itemTitle, $itemLink)
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
    <image>
      <title>{$imageTitle}</title>
      <link>{$imageLink}</link>
      <url>{$imageUrl}</url>
    </image>
    <item>
      <guid>{$itemLink}</guid>
      <title>{$itemTitle}</title>
      <link>{$itemLink}</link>
      <description>{$itemDescription}</description>
      <author>{$itemAuthor}</author>
      <category>{$itemCategory}</category>
      <pubDate>{$itemDate->format(DateTime::RFC822)}</pubDate>
    </item>
    <item>
      <guid>{$itemLink}</guid>
      <title>{$itemTitle}</title>
      <link>{$itemLink}</link>
    </item>
  </channel>
</rss>

XML;
        $this->assertSame((string)$expected, (string)$rss2);
    }
}
