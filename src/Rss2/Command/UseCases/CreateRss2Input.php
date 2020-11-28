<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;

final class CreateRss2Input implements CreateRss2InputPort
{
    /**
     * @var XmlVersion
     */
    private XmlVersion $xmlVersion;

    /**
     * @var XmlEncoding
     */
    private XmlEncoding $xmlEncoding;

    /**
     * @var Channel
     */
    private Channel $channel;

    public function __construct(
        XmlVersion $xmlVersion,
        XmlEncoding $xmlEncoding,
        Channel $channel
    ) {
        $this->xmlVersion = $xmlVersion;
        $this->xmlEncoding = $xmlEncoding;
        $this->channel = $channel;
    }

    public function xmlVersion(): XmlVersion
    {
        return $this->xmlVersion;
    }

    public function xmlEncoding(): XmlEncoding
    {
        return $this->xmlEncoding;
    }

    public function channel(): Channel
    {
        return $this->channel;
    }
}
