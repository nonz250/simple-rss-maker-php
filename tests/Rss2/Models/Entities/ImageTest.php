<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Entities;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Image;
use Tests\TestHelper\StrTestHelper;

final class ImageTest extends TestCase
{
    public function test_construct()
    {
        $title = new Title(StrTestHelper::createRandomStr());
        $link = new Url(StrTestHelper::createRandomUrl());
        $url = new Url(StrTestHelper::createRandomUrl());
        $image = new Image($title, $link, $url);
        $this->assertInstanceOf(Image::class, $image);
        $this->assertSame((string)$title, (string)$image->title());
        $this->assertSame((string)$link, (string)$image->link());
        $this->assertSame((string)$url, (string)$image->url());
        return $image;
    }
}
