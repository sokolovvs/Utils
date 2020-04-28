<?php


namespace Tests\Unit\DateTimeUtils;


use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsCastToTimeZoneTest extends TestCase
{
    public function test()
    {
        $dt = new DateTime('20-12-2000 14:14:14', new DateTimeZone('Asia/Omsk'));
        $timeZoneUTC = new DateTimeZone('UTC');
        $actual = DateTimeUtils::castToTimeZone($dt, $timeZoneUTC)
            ->format('d-m-Y H:i:s');
        $this->assertEquals('20-12-2000 08:14:14', $actual);
        $actual = DateTimeUtils::castToDefaultTimeZone(new \DateTime('20-12-2000 08:14:14', new \DateTimeZone('+8')))
            ->format('d-m-Y H:i:s');
        $this->assertEquals('20-12-2000 00:14:14', $actual);
    }
}
