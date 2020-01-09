<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsIsValidDateTimeStringTest extends DateTimeUtilsTest
{
    public function testMustReturnTrueIfParameterIsValidDate(): void
    {
        $dateTimeAsString = '2019/01/30 00:01:02';

        $this->assertTrue(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '30.01.2019 00:01:02';

        $this->assertTrue(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '30-01-2019 00:01:02';

        $this->assertTrue(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );
    }

    public function testMustReturnFalseIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertFalse($this->dateTimeUtils->isValidDateTimeString(new \DateTimeImmutable()));
        $this->assertFalse($this->dateTimeUtils->isValidDateTimeString(''));
        $this->assertFalse($this->dateTimeUtils->isValidDateTimeString([]));
        $this->assertFalse($this->dateTimeUtils->isValidDateTimeString(-12132333223323));
        $this->assertFalse($this->dateTimeUtils->isValidDateTimeString(34.5623223233232));

        $dateTimeAsString = '2019/30/01 00:01:02';

        $this->assertFalse(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '01.30.2019 00:01:02';

        $this->assertFalse(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '01-30-2019 00:01:02';

        $this->assertFalse(
            $this->dateTimeUtils->isValidDateTimeString($dateTimeAsString)
        );
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertTrue(
            $this->dateTimeUtils->isValidDateTimeString('@1578332712')
        );
    }
}
