<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Image;

final class ImageFactory implements ImageFactoryInterface
{
    public function newImage(
        string $title,
        string $link,
        string $url
    ): Image {
        return new Image(
            new Title($title),
            new Url($link),
            new Url($url)
        );
    }
}
