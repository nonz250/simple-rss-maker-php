<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\Entities;

use SimpleRssMaker\Rss2\Models\ValueObjects\Author;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;

final class Item
{
    /**
     * @var Url
     */
    private Url $guid;

    /**
     * @var Title
     */
    private Title $title;

    /**
     * @var Url
     */
    private Url $link;

    /**
     * @var Description|null
     */
    private ?Description $description;

    /**
     * @var Author|null
     */
    private ?Author $author;

    /**
     * @var Category|null
     */
    private ?Category $category;

    /**
     * @var Date|null
     */
    private ?Date $pubDate;


    public function __construct(
        Url $guid,
        Title $title,
        Url $link,
        ?Description $description,
        ?Author $author,
        ?Category $category,
        ?Date $pubDate
    ) {
        $this->guid = $guid;
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->author = $author;
        $this->category = $category;
        $this->pubDate = $pubDate;
    }

    /**
     * @return Description|null
     */
    public function description(): ?Description
    {
        return $this->description;
    }

    /**
     * @return Author|null
     */
    public function author(): ?Author
    {
        return $this->author;
    }

    /**
     * @return Category|null
     */
    public function category(): ?Category
    {
        return $this->category;
    }

    /**
     * @return Url
     */
    public function guid(): Url
    {
        return $this->guid;
    }

    /**
     * @return Url
     */
    public function link(): Url
    {
        return $this->link;
    }

    /**
     * @return Date|null
     */
    public function pubDate(): ?Date
    {
        return $this->pubDate;
    }

    /**
     * @return Title
     */
    public function title(): Title
    {
        return $this->title;
    }

    /**
     * @param Description $description
     */
    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @param Date $pubDate
     */
    public function setPubDate(Date $pubDate): void
    {
        $this->pubDate = $pubDate;
    }
}
