<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsGetDateTimeMutableFromStringTest extends TestCase
{
    public function testReturnDateTimeIfParameterValidDateTimeString(): void
    {
        $dateTimeAsString = '2019/01/01';

        $this->assertEquals(
            new \DateTime($dateTimeAsString),
            DateTimeUtils::getDateTimeMutableOrNullFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull(DateTimeUtils::getDateTimeMutableOrNullFromString(new \DateTime()));
        $this->assertNull(DateTimeUtils::getDateTimeMutableOrNullFromString(''));
        $this->assertNull(DateTimeUtils::getDateTimeMutableOrNullFromString([]));
        $this->assertNull(DateTimeUtils::getDateTimeMutableOrNullFromString(-12132333223323));
        $this->assertNull(DateTimeUtils::getDateTimeMutableOrNullFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTime('@1578332712'), DateTimeUtils::getDateTimeMutableOrNullFromString('@1578332712')
        );
    }

}
