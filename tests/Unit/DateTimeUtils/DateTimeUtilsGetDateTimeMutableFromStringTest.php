<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsGetDateTimeMutableFromStringTest extends DateTimeUtilsTest
{
    public function testReturnDateTimeIfParameterValidDateTimeString(): void
    {
        $dateTimeAsString = '2019/01/01';

        $this->assertEquals(
            new \DateTime($dateTimeAsString),
            $this->dateTimeUtils->getDateTimeMutableOrNullFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull($this->dateTimeUtils->getDateTimeMutableOrNullFromString(new \DateTime()));
        $this->assertNull($this->dateTimeUtils->getDateTimeMutableOrNullFromString(''));
        $this->assertNull($this->dateTimeUtils->getDateTimeMutableOrNullFromString([]));
        $this->assertNull($this->dateTimeUtils->getDateTimeMutableOrNullFromString(-12132333223323));
        $this->assertNull($this->dateTimeUtils->getDateTimeMutableOrNullFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTime('@1578332712'), $this->dateTimeUtils->getDateTimeMutableOrNullFromString('@1578332712')
        );
    }

}
