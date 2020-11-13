<?php
declare(strict_types=1);

namespace Tests\Shared\Models\ValueObjects;

use DateTime;
use DateTimeZone;
use Exception;
use SimpleRssMaker\Shared\Models\ValueObjects\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test__construct()
    {
        $expects = new DateTime('now', new DateTimeZone('UTC'));
        $date = new Date($expects);
        $this->assertInstanceOf(Date::class, $date);
        $this->assertEquals($expects->format(DateTime::RFC822), (string)$date);
    }
}
