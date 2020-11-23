<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Collections;

use InvalidArgumentException;
use SimpleRssMaker\Foundation\Collection;
use SimpleRssMaker\Rss2\Models\Entities\Item;

final class ItemCollection extends Collection
{
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            if (!$item instanceof Item) {
                throw new InvalidArgumentException(
                    sprintf(
                        '%s\'s Item must be %s type.',
                        get_class(),
                        Item::class
                    )
                );
            }
        }
        $this->items = $items;
    }

    public function push(Item $item)
    {
        $this->items[] = $item;
    }
}
