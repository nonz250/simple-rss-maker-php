<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;

final class ChannelFactory implements ChannelFactoryInterface
{
    public function newChannel(string $title, string $link, string $description): Channel
    {
        return new Channel(
            new Title($title),
            new Url($link),
            new Description($description),
            new Language(Language::LANGUAGE_JAPANESE),
            new Copyright(''),
            new Category(''),
            null,
            null
        );
    }
}
