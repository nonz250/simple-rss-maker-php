<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Models\ValueObjects;

final class Title
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function __toString(): string
    {
        return (string)$this->title;
    }
}
