<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Item;

final class ItemFactory implements ItemFactoryInterface
{
    public function newItem(string $title, string $link): Item
    {
        $guid = new Url($link);
        return new Item(
            $guid,
            new Title($title),
            new Url($link),
            new Description(''),
            new Author(''),
            new Category(''),
            null
        );
    }
}
