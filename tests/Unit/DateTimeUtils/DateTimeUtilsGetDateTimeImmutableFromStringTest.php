<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsGetDateTimeImmutableFromStringTest extends TestCase
{
    public function testReturnDateTimeIfParameterValidDateTimeString(): void
    {
        $dateTimeAsString = '2019/01/01 00:01:02';

        $this->assertEquals(
            new \DateTimeImmutable($dateTimeAsString),
            DateTimeUtils::getDateTimeImmutableOrNullFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull(DateTimeUtils::getDateTimeImmutableOrNullFromString(new \DateTimeImmutable()));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableOrNullFromString(''));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableOrNullFromString([]));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableOrNullFromString(-12132333223323));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableOrNullFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTimeImmutable('@1578332712'), DateTimeUtils::getDateTimeImmutableOrNullFromString('@1578332712')
        );
    }

}
