<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Factories;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Factories\ItemFactory;
use SimpleRssMaker\Shared\Models\Entities\Item;
use Tests\TestHelper\StrTestHelper;

final class ItemFactoryTest extends TestCase
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
