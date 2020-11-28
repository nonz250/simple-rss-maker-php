<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Shared\Models\Entities\Item;

interface ItemFactoryInterface
{
    public function newItem(string $title, string $link): Item;
}
