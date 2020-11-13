<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;

interface CreateRss2InputPort
{
    public function xmlVersion(): XmlVersion;

    public function xmlEncoding(): XmlEncoding;

    public function channel(): Channel;
}
