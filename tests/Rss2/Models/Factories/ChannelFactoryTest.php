<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Factories;

use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use Tests\TestHelper\StrTestHelper;

final class ChannelFactoryTest extends TestCase
{
    public function testNewChannel(): void
    {
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $description = StrTestHelper::createRandomStr();
        $factory = new ChannelFactory();
        $channel = $factory->newChannel($title, $link, $description);
        $this->assertInstanceOf(Channel::class, $channel);
    }
}
