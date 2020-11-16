<?php
declare(strict_types=1);

namespace SimpleRssMaker\Foundation;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate, Countable
{
    protected array $items = [];

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count()
    {
        return count($this->items);
    }
}
