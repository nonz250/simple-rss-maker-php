<?php
declare(strict_types=1);

namespace SimpleRssMaker;

use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Input;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Output;
use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Rss2\Models\Entities\Image;
use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use SimpleRssMaker\Rss2\Models\Factories\ImageFactory;
use SimpleRssMaker\Shared\Exceptions\ChannelNotExistException;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;

class SimpleRssMaker implements SimpleRssMakerInterface
{
    /**
     * @var XmlEncoding
     */
    private XmlEncoding $xmlEncoding;

    /**
     * @var Channel|null
     */
    private ?Channel $channel;

    public function __construct(string $xmlEncoding = XmlEncoding::UTF8)
    {
        $this->xmlEncoding = new XmlEncoding($xmlEncoding);
        $this->channel = null;
    }

    public function channelFactory(
        string $title,
        string $link,
        string $description
    ): Channel {
        $factory = new ChannelFactory();
        return $factory->newChannel($title, $link, $description);
    }

    public function setChannel(Channel $channel): SimpleRssMakerInterface
    {
        $this->channel = $channel;
        return $this;
    }

    public function imageFactory(
        string $title,
        string $link,
        string $url
    ): Image {
        $factory = new ImageFactory();
        return $factory->newImage($title, $link, $url);
    }

    public function rss2(): string
    {
        if (!$this->channel instanceof Channel) {
            throw new ChannelNotExistException(
                'Channel is required. Use `channelFactory` and `setChannel` methods to set channel.'
            );
        }
        $input = new CreateRss2Input(
            new XmlVersion(XmlVersion::VERSION_1),
            $this->xmlEncoding,
            $this->channel
        );
        $output = new CreateRss2Output();
        $useCase = new CreateRss2();
        $useCase->process($input, $output);
        $rss2dom = $output->rss2();
        return (string)$rss2dom;
    }
}
