<?php
declare(strict_types=1);

namespace SimpleRssMaker\Rss2\Command\UseCases;

interface CreateRss2Interface
{
    public function process(CreateRss2InputPort $inputPort, CreateRss2OutputPort $outputPort): void;
}
