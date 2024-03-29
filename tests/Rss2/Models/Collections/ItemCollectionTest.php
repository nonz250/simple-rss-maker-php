<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Collections;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\Entities\Item;
use Tests\TestHelper\StrTestHelper;

final class ItemCollectionTest extends TestCase
{
    /**
     * @var array
     */
    private array $array = [];

    protected function setUp(): void
    {
        parent::setUp();
        $num = 10;

        for ($i = 0; $i < $num; $i++) {
            $this->array[] = new Item(
                new Url(StrTestHelper::createRandomUrl()),
                new Title(StrTestHelper::createRandomStr()),
                new Url(StrTestHelper::createRandomUrl()),
                null,
                null,
                null,
                null
            );
        }
    }

    /**
     * @throws Exception
     *
     * @return ItemCollection
     */
    public function test__construct(): ItemCollection
    {
        $items = new ItemCollection($this->array);
        $this->assertInstanceOf(ItemCollection::class, $items);
        $this->assertIsIterable($items);
        $this->assertIsIterable($items->getIterator());
        $this->assertCount(count($this->array), $items);
        return $items;
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ItemCollection(['unknown']);
    }

    /**
     * @depends test__construct
     *
     * @param ItemCollection $itemCollection
     */
    public function testPush(ItemCollection $itemCollection): void
    {
        $this->assertCount(count($this->array), $itemCollection);
        $itemCollection->push(new Item(
            new Url(StrTestHelper::createRandomUrl()),
            new Title(StrTestHelper::createRandomStr()),
            new Url(StrTestHelper::createRandomUrl()),
            null,
            null,
            null,
            null,
        ));
        $this->assertCount(count($this->array) + 1, $itemCollection);
    }
}
