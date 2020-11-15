<?php
declare(strict_types=1);

namespace SimpleRssMaker;

use DateTimeInterface;
use SimpleRssMaker\Rss2\Models\Entities\Channel;

interface SimpleRssMakerInterface
{
    public function channelFactory(
        string $title,
        string $link,
        string $description
    ): Channel;

    public function setChannel(Channel $channel): self;

    public function rss2(): string;
}
