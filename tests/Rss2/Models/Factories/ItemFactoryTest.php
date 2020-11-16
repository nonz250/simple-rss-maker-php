<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\Entities\Item;
use SimpleRssMaker\Rss2\Models\Factories\ItemFactory;
use PHPUnit\Framework\TestCase;
use Tests\TestHelper\StrTestHelper;

class ItemFactoryTest extends TestCase
{
    public function testNewFactory()
    {
        $factory = new ItemFactory();
        $item = $factory->newItem(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
        );
        $this->assertInstanceOf(Item::class, $item);
        return $item;
    }
}
