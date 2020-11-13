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
        string $description,
        string $language = '',
        string $copyright = '',
        string $category = '',
        ?DateTimeInterface $pubDate = null
    ): Channel;

    public function setChannel(Channel $channel): self;

    public function rss2(): string;
}
