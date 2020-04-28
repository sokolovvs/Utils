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
            DateTimeUtils::getDateTimeMutableFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull(DateTimeUtils::getDateTimeMutableFromString(new \DateTime()));
        $this->assertNull(DateTimeUtils::getDateTimeMutableFromString(''));
        $this->assertNull(DateTimeUtils::getDateTimeMutableFromString([]));
        $this->assertNull(DateTimeUtils::getDateTimeMutableFromString(-12132333223323));
        $this->assertNull(DateTimeUtils::getDateTimeMutableFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTime('@1578332712'), DateTimeUtils::getDateTimeMutableFromString('@1578332712')
        );
    }

}
