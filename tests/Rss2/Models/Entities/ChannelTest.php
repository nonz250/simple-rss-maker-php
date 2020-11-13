<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use SimpleRssMaker\Rss2\Models\Entities\Channel;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Link;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use Tests\TestHelper\StrTestHelper;

class ChannelTest extends TestCase
{
    public function test__construct()
    {
        $title = new Title(StrTestHelper::createRandomStr());
        $link = new Link(StrTestHelper::createRandomUrl());
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
        return $channel;
    }
}
