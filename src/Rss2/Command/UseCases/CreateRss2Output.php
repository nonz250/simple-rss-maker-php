<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

use SimpleRssMaker\Rss2\Models\Entities\Rss2;

final class CreateRss2Output implements CreateRss2OutputPort
{
    private Rss2 $RSS2;

    public function output(Rss2 $RSS2): void
    {
        $this->RSS2 = $RSS2;
    }

    public function rss2(): Rss2
    {
        return $this->RSS2;
    }
}
