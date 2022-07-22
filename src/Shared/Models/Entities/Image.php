<?php
declare(strict_types=1);

namespace SimpleRssMaker\Shared\Models\Entities;

use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;

final class Image
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
     * @var Url
     */
    private Url $url;

    public function __construct(
        Title $title,
        Url $link,
        Url $url
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->url = $url;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function link(): Url
    {
        return $this->link;
    }

    public function url(): Url
    {
        return $this->url;
    }
}
