<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsGetDateTimeImmutableFromStringTest extends DateTimeUtilsTest
{
    public function testReturnDateTimeIfParameterValidDateTimeString(): void
    {
        $dateTimeAsString = '2019/01/01 00:01:02';

        $this->assertEquals(
            new \DateTimeImmutable($dateTimeAsString),
            $this->dateTimeUtils->getDateTimeImmutableOrNullFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull($this->dateTimeUtils->getDateTimeImmutableOrNullFromString(new \DateTimeImmutable()));
        $this->assertNull($this->dateTimeUtils->getDateTimeImmutableOrNullFromString(''));
        $this->assertNull($this->dateTimeUtils->getDateTimeImmutableOrNullFromString([]));
        $this->assertNull($this->dateTimeUtils->getDateTimeImmutableOrNullFromString(-12132333223323));
        $this->assertNull($this->dateTimeUtils->getDateTimeImmutableOrNullFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTimeImmutable('@1578332712'), $this->dateTimeUtils->getDateTimeImmutableOrNullFromString('@1578332712')
        );
    }

}
