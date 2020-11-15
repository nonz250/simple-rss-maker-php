<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Entities;

use DateTimeInterface;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;

final class Channel
{
    /**
     * @var Title
     */
    private Title $title;

    /**
     * @var Url
     */
    private Url $link;

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

    /**
     * @var Date|null
     */
    private ?Date $pubDate;

    /**
     * @var Image|null
     */
    private ?Image $image;

    public function __construct(
        Title $title,
        Url $link,
        Description $description,
        Language $language,
        Copyright $copyright,
        Category $category,
        ?Date $pubDate,
        ?Image $image
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->language = $language;
        $this->copyright = $copyright;
        $this->category = $category;
        $this->pubDate = $pubDate;
        $this->image = $image;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function link(): Url
    {
        return $this->link;
    }

    public function description(): Description
    {
        return $this->description;
    }

    public function language(): Language
    {
        return $this->language;
    }

    public function copyright(): Copyright
    {
        return $this->copyright;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function pubDate(): ?Date
    {
        return $this->pubDate;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function setLanguage(string $language): void
    {
        $this->language = new Language($language);
    }

    public function setCopyright(string $copyright): void
    {
        $this->copyright = new Copyright($copyright);
    }

    public function setCategory(string $category): void
    {
        $this->category = new Category($category);
    }

    public function setPubDate(DateTimeInterface $pubDate): void
    {
        $this->pubDate = new Date($pubDate);
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }
}
