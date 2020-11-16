<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Collections;

use Exception;
use InvalidArgumentException;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Entities\Item;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use Tests\TestHelper\StrTestHelper;

class ItemCollectionTest extends TestCase
{
    /**
     * @throws Exception
     * @return ItemCollection
     */
    public function test__construct()
    {
        $array = [];
        $num = 10;
        for ($i = 0; $i < $num; $i++) {
            $array[] = new Item(
                new Url(StrTestHelper::createRandomUrl()),
                new Title(StrTestHelper::createRandomStr()),
                new Url(StrTestHelper::createRandomUrl()),
                null,
                null,
                null,
                null
            );
        }
        $items = new ItemCollection($array);
        $this->assertInstanceOf(ItemCollection::class, $items);
        $this->assertIsIterable($items);
        $this->assertIsIterable($items->getIterator());
        $this->assertCount($num, $items);
        return $items;
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        new ItemCollection(['unknown']);
    }
}
