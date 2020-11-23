<?php
declare(strict_types=1);

namespace SimpleRssMaker;

use DateTimeInterface;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;

interface SimpleRssMakerInterface
{
    public function setChannel(
        string $title,
        string $link,
        string $description,
        string $language = Language::LANGUAGE_JAPANESE,
        string $copyright = '',
        string $category = '',
        ?DateTimeInterface $pubDate = null
    ): self;

    public function setImage(
        string $title,
        string $link,
        string $url
    ): self;

    public function addItem(
        string $title,
        string $link,
        string $description = '',
        string $author = '',
        string $category = '',
        ?DateTimeInterface $pubDate = null
    ): self;

    public function rss2(): string;
}
