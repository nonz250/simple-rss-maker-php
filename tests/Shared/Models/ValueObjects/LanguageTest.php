<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\Language;

final class LanguageTest extends TestCase
{
    public function testCreateJapanese(): void
    {
        $language = new Language(Language::LANGUAGE_JAPANESE);
        $this->assertSame(Language::LANGUAGE_JAPANESE, $language->value());
        $this->assertSame(Language::LANGUAGE_JAPANESE, (string)$language);
    }

    public function testCreateEnglish(): void
    {
        $language = new Language(Language::LANGUAGE_ENGLISH);
        $this->assertSame(Language::LANGUAGE_ENGLISH, $language->value());
        $this->assertSame(Language::LANGUAGE_ENGLISH, (string)$language);
    }

    public function testCreateEnglishUs(): void
    {
        $language = new Language(Language::LANGUAGE_ENGLISH_US);
        $this->assertSame(Language::LANGUAGE_ENGLISH_US, $language->value());
        $this->assertSame(Language::LANGUAGE_ENGLISH_US, (string)$language);
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Language('unknown');
    }
}
