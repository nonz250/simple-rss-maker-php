<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

use SimpleRssMaker\Rss2\Models\Entities\Rss2;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;

final class CreateRss2 implements CreateRss2Interface
{
    public function process(CreateRss2InputPort $inputPort, CreateRss2OutputPort $outputPort): void
    {
        $xmlVersion = $inputPort->xmlVersion();
        $xmlEncoding = $inputPort->xmlEncoding();
        $channel = $inputPort->channel();
        $rssVersion = new RssVersion(RssVersion::VERSION_2);
        $rss2 = new Rss2($xmlVersion, $xmlEncoding, $rssVersion, $channel);
        $outputPort->output($rss2);
    }
}
