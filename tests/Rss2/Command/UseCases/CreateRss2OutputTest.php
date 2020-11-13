<?php
declare(strict_types=1);

namespace Tests\Rss2\Command\UseCases;

use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Output;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Entities\Rss2;
use SimpleRssMaker\Rss2\Models\Factories\ChannelFactory;
use SimpleRssMaker\Shared\Models\ValueObjects\RssVersion;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use Tests\TestHelper\StrTestHelper;

class CreateRss2OutputTest extends TestCase
{
    private XmlVersion $xmlVersion;
    private XmlEncoding $xmlEncoding;
    private RssVersion $rssVersion;

    protected function setUp(): void
    {
        parent::setUp();
        $this->xmlVersion = new XmlVersion(XmlVersion::VERSION_1);
        $this->xmlEncoding = new XmlEncoding(XmlEncoding::UTF8);
        $this->rssVersion = new RssVersion(RssVersion::VERSION_2);
    }
    public function testOutput()
    {
        $output = new CreateRss2Output();
        $this->assertInstanceOf(CreateRss2Output::class, $output);

        $factory = new ChannelFactory();
        $channel = $factory->newChannel(
            StrTestHelper::createRandomStr(),
            StrTestHelper::createRandomUrl(),
            StrTestHelper::createRandomStr(),
        );
        $rss2 = new Rss2($this->xmlVersion, $this->xmlEncoding, $this->rssVersion, $channel);
        $output->output($rss2);
        $this->assertInstanceOf(Rss2::class, $output->rss2());
    }
}
