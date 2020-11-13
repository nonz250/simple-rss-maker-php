<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function testCreateJapanese()
    {
        $language = new Language(Language::LANGUAGE_JAPANESE);
        $this->assertEquals(Language::LANGUAGE_JAPANESE, $language->value());
        $this->assertEquals(Language::LANGUAGE_JAPANESE, (string)$language);
    }

    public function testCreateEnglish()
    {
        $language = new Language(Language::LANGUAGE_ENGLISH);
        $this->assertEquals(Language::LANGUAGE_ENGLISH, $language->value());
        $this->assertEquals(Language::LANGUAGE_ENGLISH, (string)$language);
    }

    public function testCreateEnglishUs()
    {
        $language = new Language(Language::LANGUAGE_ENGLISH_US);
        $this->assertEquals(Language::LANGUAGE_ENGLISH_US, $language->value());
        $this->assertEquals(Language::LANGUAGE_ENGLISH_US, (string)$language);
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Language('unknown');
    }
}
