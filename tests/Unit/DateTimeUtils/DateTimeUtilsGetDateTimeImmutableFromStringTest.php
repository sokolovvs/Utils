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
            DateTimeUtils::getDateTimeImmutableFromString($dateTimeAsString)
        );
    }

    public function testReturnNullIfParameterIsInvalidDateTimeString(): void
    {
        $this->assertNull(DateTimeUtils::getDateTimeImmutableFromString(new \DateTimeImmutable()));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableFromString(''));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableFromString([]));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableFromString(-12132333223323));
        $this->assertNull(DateTimeUtils::getDateTimeImmutableFromString(34.5623223233232));
    }

    public function testReturnDateTimeIfParameterIsTimestamp(): void
    {
        $this->assertEquals(
            new \DateTimeImmutable('@1578332712'), DateTimeUtils::getDateTimeImmutableFromString('@1578332712')
        );
    }

}
