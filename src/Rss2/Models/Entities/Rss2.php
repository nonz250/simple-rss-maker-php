<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Entities;

use DOMDocument;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use SimpleXMLElement;

final class Rss2
{
    protected const RSS_TAG = 'rss';

    /**
     * @var XmlVersion
     */
    private XmlVersion $xmlVersion;

    /**
     * @var XmlEncoding
     */
    private XmlEncoding $xmlEncoding;

    /**
     * @var RssVersion
     */
    private RssVersion $rssVersion;

    /**
     * @var Channel
     */
    private Channel $channel;

    public function __construct(
        XmlVersion $xmlVersion,
        XmlEncoding $xmlEncoding,
        RssVersion $rssVersion,
        Channel $channel
    ) {
        $this->xmlVersion = $xmlVersion;
        $this->xmlEncoding = $xmlEncoding;
        $this->rssVersion = $rssVersion;
        $this->channel = $channel;
    }

    public function createSimpleXmlElement(): SimpleXMLElement
    {
        $rss = $this->createRssElement();
        $rss->addAttribute('version', (string)$this->rssVersion);

        if ($this->channel) {
            $channel = $rss->addChild('channel');
            $channel->addChild('title', (string)$this->channel->title());
            $channel->addChild('link', (string)$this->channel->link());
            $channel->addChild('description', (string)$this->channel->description());
            $channel->addChild('language', (string)$this->channel->language());
            if (!$this->channel->copyright()->isEmpty()) {
                $channel->addChild('copyright', (string)$this->channel->copyright());
            }
            if ($this->channel->pubDate()) {
                $channel->addChild('pubDate', (string)$this->channel->pubDate());
            }
            if (!$this->channel->category()->isEmpty()) {
                $channel->addChild('category', (string)$this->channel->category());
            }
            if ($this->channel->image()) {
                $image = $channel->addChild('image');
                $image->addChild('title', (string)$this->channel->image()->title());
                $image->addChild('link', (string)$this->channel->image()->link());
                $image->addChild('url', (string)$this->channel->image()->url());
            }
            $itemCollection = $this->channel->itemCollection();
            /** @var Item $item */
            foreach ($itemCollection as $item) {
                $itemElement = $channel->addChild('item');
                $itemElement->addChild('guid', (string)$item->guid());
                $itemElement->addChild('title', (string)$item->title());
                $itemElement->addChild('link', (string)$item->link());
                if (!$item->description()->isEmpty()) {
                    $itemElement->addChild('description', (string)$item->description());
                }
                if (!$item->author()->isEmpty()) {
                    $itemElement->addChild('author', (string)$item->author());
                }
                if (!$item->category()->isEmpty()) {
                    $itemElement->addChild('category', (string)$item->category());
                }
                if ($item->pubDate()) {
                    $itemElement->addChild('pubDate', (string)$item->pubDate());
                }
            }
        }

        return $rss;
    }

    public function __toString(): string
    {
        $dom = dom_import_simplexml($this->createSimpleXmlElement())->ownerDocument;
        $dom->formatOutput = true;
        return $dom->saveXML();
    }

    private function createRssElement(): SimpleXMLElement
    {
        $dom = new DOMDocument((string)$this->xmlVersion, (string)$this->xmlEncoding);
        $rss = $dom->createElement(self::RSS_TAG);
        $dom->appendChild($rss);
        $xml = $dom->saveXML();
        return new SimpleXMLElement($xml);
    }
}
