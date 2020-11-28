<?php
declare(strict_types=1);

namespace Tests\Rss2\Command\UseCases;

use DateTime;
use DateTimeZone;
use Exception;
use SimpleRssMaker\Rss2\Command\UseCases\CreateRss2Input;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Rss2\Models\Collections\ItemCollection;
use SimpleRssMaker\Rss2\Models\ValueObjects\Category;
use SimpleRssMaker\Rss2\Models\ValueObjects\Description;
use SimpleRssMaker\Rss2\Models\ValueObjects\Url;
use SimpleRssMaker\Rss2\Models\ValueObjects\Title;
use SimpleRssMaker\Shared\Models\Entities\Channel;
use SimpleRssMaker\Shared\Models\ValueObjects\Copyright;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlEncoding;
use SimpleRssMaker\Shared\Models\ValueObjects\XmlVersion;
use Tests\TestHelper\StrTestHelper;

class CreateRss2InputTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test__construct()
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

        $this->assertInstanceOf(XmlVersion::class, $input->xmlVersion());
        $this->assertInstanceOf(XmlEncoding::class, $input->xmlEncoding());
        $this->assertInstanceOf(Channel::class, $input->channel());
    }
}
