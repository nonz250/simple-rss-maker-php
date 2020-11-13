<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Entities;

use DateTimeInterface;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Link;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;

final class Channel
{
    /**
     * @var Title
     */
    private Title $title;

    /**
     * @var Link
     */
    private Link $link;

    /**
     * @var Description
     */
    private Description $description;

    /**
     * @var Language
     */
    private Language $language;

    /**
     * @var Copyright
     */
    private Copyright $copyright;

    /**
     * @var Category
     */
    private Category $category;

    private ?DateTimeInterface $pubDate;

    public function __construct(
        Title $title,
        Link $link,
        Description $description,
        Language $language,
        Copyright $copyright,
        Category $category,
        ?DateTimeInterface $pubDate
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->language = $language;
        $this->copyright = $copyright;
        $this->category = $category;
        $this->pubDate = $pubDate;
    }
}
