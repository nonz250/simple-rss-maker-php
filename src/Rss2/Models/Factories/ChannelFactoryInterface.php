<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Factories;

use SimpleRssMaker\Rss2\Models\Entities\Channel;

interface ChannelFactoryInterface
{
    public function newChannel(
        string $title,
        string $link,
        string $description
    ): Channel;
}
