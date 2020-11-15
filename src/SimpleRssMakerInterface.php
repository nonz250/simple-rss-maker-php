<?php
declare(strict_types=1);

namespace SimpleRssMaker;

use DateTimeInterface;
use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Rss2\Models\Entities\Image;

interface SimpleRssMakerInterface
{
    public function channelFactory(
        string $title,
        string $link,
        string $description
    ): Channel;

    public function setChannel(Channel $channel): self;

    public function imageFactory(
        string $title,
        string $link,
        string $url
    ): Image;

    public function rss2(): string;
}
