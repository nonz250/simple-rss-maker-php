<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Shared\Models\Entities\Image;

interface ImageFactoryInterface
{
    public function newImage(
        string $title,
        string $link,
        string $url
    ): Image;
}
