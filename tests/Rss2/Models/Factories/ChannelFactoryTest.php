<?php
declare(strict_types=1);

namespace Tests\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use Tests\TestHelper\StrTestHelper;

class ChannelFactoryTest extends TestCase
{
    public function testNewChannel()
    {
        $title = StrTestHelper::createRandomStr();
        $link = StrTestHelper::createRandomUrl();
        $description = StrTestHelper::createRandomStr();
        $factory = new ChannelFactory();
        $channel = $factory->newChannel($title, $link, $description);
        $this->assertInstanceOf(Channel::class, $channel);
    }
}
