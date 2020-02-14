<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsIsValidDateTimeStringTest extends TestCase
{
    public function testMustReturnTrueIfParameterIsValidDate(): void
    {
        $dateTimeAsString = '2019/01/30 00:01:02';

        $this->assertTrue(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '30.01.2019 00:01:02';

        $this->assertTrue(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '30-01-2019 00:01:02';

        $this->assertTrue(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );
    }

    public function testMustReturnFalseIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertFalse(DateTimeUtils::isValidDateTimeString(new \DateTimeImmutable()));
        $this->assertFalse(DateTimeUtils::isValidDateTimeString(''));
        $this->assertFalse(DateTimeUtils::isValidDateTimeString([]));
        $this->assertFalse(DateTimeUtils::isValidDateTimeString(-12132333223323));
        $this->assertFalse(DateTimeUtils::isValidDateTimeString(34.5623223233232));

        $dateTimeAsString = '2019/30/01 00:01:02';

        $this->assertFalse(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '01.30.2019 00:01:02';

        $this->assertFalse(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );

        $dateTimeAsString = '01-30-2019 00:01:02';

        $this->assertFalse(
            DateTimeUtils::isValidDateTimeString($dateTimeAsString)
        );
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertTrue(
            DateTimeUtils::isValidDateTimeString('@1578332712')
        );
    }
}
