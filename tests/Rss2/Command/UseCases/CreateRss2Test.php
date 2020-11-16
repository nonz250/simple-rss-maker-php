<?php
declare(strict_types=1);

namespace Tests\Rss2\Command\UseCases;

use DateTime;
use DateTimeZone;
use Exception;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Input;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Output;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Rss2\Models\Entities\Channel;
use SimpleRssMaker\Rss2\Models\Entities\Rss2;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use Tests\TestHelper\StrTestHelper;

class CreateRss2Test extends TestCase
{
    /**
     * @throws Exception
     */
    public function testProcess()
    {
        $input = new CreateRss2Input(
            new XmlVersion(XmlVersion::VERSION_1),
            new XmlEncoding(XmlEncoding::UTF8),
            new Channel(
                new Title(StrTestHelper::createRandomStr()),
                new Url(StrTestHelper::createRandomUrl()),
                new Description(StrTestHelper::createRandomStr()),
                new Language(Language::LANGUAGE_JAPANESE),
                new Copyright(StrTestHelper::createRandomStr()),
                new Category(StrTestHelper::createRandomStr()),
                new Date(new DateTime('now', new DateTimeZone('UTC'))),
                null,
                new ItemCollection()
            ),
        );
        $output = new CreateRss2Output();
        $useCase = new CreateRss2();
        $this->assertInstanceOf(CreateRss2::class, $useCase);
        $useCase->process($input, $output);
        $this->assertInstanceOf(Rss2::class, $output->rss2());
    }
}
