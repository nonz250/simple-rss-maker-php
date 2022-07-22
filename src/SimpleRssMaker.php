<?php
declare(strict_types=1);

namespace SimpleRssMaker;

use DateTimeInterface;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Input;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Output;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use SimpleRssMaker\Rss2\Models\Factories\ImageFactory;
use SimpleRssMaker\Rss2\Models\Factories\ItemFactory;
use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Shared\Exceptions\ChannelNotExistException;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\Entities\Image;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;

final class SimpleRssMaker implements SimpleRssMakerInterface
{
    /**
     * @var XmlEncoding
     */
    private XmlEncoding $xmlEncoding;

    /**
     * @var Channel|null
     */
    private ?Channel $channel;

    /**
     * @var Image
     */
    private Image $image;

    /**
     * @var ItemCollection
     */
    private ItemCollection $itemCollection;

    public function __construct(string $xmlEncoding = XmlEncoding::UTF8)
    {
        $this->xmlEncoding = new XmlEncoding($xmlEncoding);
        $this->channel = null;
        $this->itemCollection = new ItemCollection();
    }

    public function setChannel(
        string $title,
        string $link,
        string $description,
        string $language = Language::LANGUAGE_JAPANESE,
        string $copyright = '',
        string $category = '',
        ?DateTimeInterface $pubDate = null
    ): SimpleRssMakerInterface {
        $factory = new ChannelFactory();
        $channel = $factory->newChannel($title, $link, $description);
        $channel->setLanguage(new Language($language));
        $channel->setCategory(new Category($category));
        $channel->setCopyright(new Copyright($copyright));

        if ($pubDate) {
            $channel->setPubDate(new Date($pubDate));
        }
        $this->channel = $channel;
        return $this;
    }

    public function setImage(
        string $title,
        string $link,
        string $url
    ): self {
        $factory = new ImageFactory();
        $this->image = $factory->newImage($title, $link, $url);
        return $this;
    }

    public function addItem(
        string $title,
        string $link,
        string $description = '',
        string $author = '',
        string $category = '',
        ?DateTimeInterface $pubDate = null
    ): self {
        $factory = new ItemFactory();
        $item = $factory->newItem($title, $link);
        $item->setDescription(new Description($description));
        $item->setAuthor(new Author($author));
        $item->setCategory(new Category($category));

        if ($pubDate) {
            $item->setPubDate(new Date($pubDate));
        }
        $this->itemCollection->push($item);
        return $this;
    }

    public function rss2(): string
    {
        if (!$this->channel instanceof Channel) {
            throw new ChannelNotExistException(
                'Channel is required. Use `channelFactory` and `setChannel` methods to set channel.'
            );
        }

        $this->channel->setImage($this->image);
        $this->channel->setItemCollection($this->itemCollection);

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
