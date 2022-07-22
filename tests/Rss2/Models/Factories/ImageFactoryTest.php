<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Factories;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Factories\ImageFactory;
use SimpleRssMaker\Shared\Models\Entities\Image;
use Tests\TestHelper\StrTestHelper;

final class ImageFactoryTest extends TestCase
{
    public function testNewImage(): void
    {
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $url = StrTestHelper::createRandomUrl();
        $factory = new ImageFactory();
        $image = $factory->newImage($title, $link, $url);
        $this->assertInstanceOf(Image::class, $image);
    }
}
