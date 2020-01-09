<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsGetRussianDateFormatTest extends DateTimeUtilsTest
{
    /**
     * @dataProvider dataProvide
     *
     * @param  \DateTimeInterface  $dateTime
     * @param  string              $expected
     */
    public function test(\DateTimeInterface $dateTime, string $expected): void
    {
        $this->assertSame($expected, $this->dateTimeUtils->getRussianDateFormat($dateTime));
    }

    public function dataProvide(): array
    {
        return [
            '13.10.2019' => [new \DateTime('13-10-2019 00:01:02'), '13.10.2019'],
            '14.10.2019' => [new \DateTimeImmutable('2019/10/14 00:01:02'), '14.10.2019'],
        ];
    }
}
