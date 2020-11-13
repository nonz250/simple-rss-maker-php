<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

use SimpleRssMaker\Rss2\Models\Entities\Rss2;

interface CreateRss2OutputPort
{
    public function output(Rss2 $RSS2DOM): void;
}
