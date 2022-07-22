<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use DateTime;
use DateTimeZone;
use Exception;
use PHPUnit\Framework\TestCase;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;

final class DateTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test__construct(): void
    {
        $expects = new \DateTimeImmutable('now', new DateTimeZone('UTC'));
        $date = new Date($expects);
        $this->assertInstanceOf(Date::class, $date);
        $this->assertSame($expects->format(DateTime::RFC822), (string)$date);
    }
}
