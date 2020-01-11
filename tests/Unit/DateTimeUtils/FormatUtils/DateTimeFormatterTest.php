<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils;


use DateTime;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\RussianFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaFormat;
use Tests\Unit\DateTimeUtils\DateTimeUtilsTest;

class DateTimeFormatterTest extends DateTimeUtilsTest
{

    /**
     * @dataProvider dataProvideForDateToFormat
     */
    public function testDateToFormat($dateTime, $format, $expected): void
    {
        $this->assertSame(
            $expected, $this->dateTimeUtils->getDateTimeFormatter()
            ->dateToFormat($dateTime, $format)
        );
    }

    public function dataProvideForDateToFormat(): array
    {
        return [
            'russian date format for datetime (2010/09/05 13:33:31) - 05.09.2010' => [
                new DateTime(
                    '2010/09/05 13:33:31'
                ),
                new RussianFormat(),
                '05.09.2010',
            ],
            'international date format for datetime (05.09.2010 13:33:31) - 05-09-2010' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new InternationalFormat(),
                '05-09-2010',
            ],
            'usa date format for datetime (05.09.2010 13:33:31) - 2010/09/05' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new UsaFormat(),
                '09-05-2010',
            ],

        ];
    }

    /**
     * @dataProvider dataProvideForDateTimeToFormat
     */
    public function testDateTimeToFormat($dateTime, $format, $expected): void
    {
        $this->assertSame(
            $expected, $this->dateTimeUtils->getDateTimeFormatter()
            ->dateTimeToFormat($dateTime, $format)
        );
    }

    public function dataProvideForDateTimeToFormat(): array
    {
        return [
            'russian date format for datetime (2010/09/05 13:33:31) - 05.09.2010 13:33:31' => [
                new DateTime(
                    '2010/09/05 13:33:31'
                ),
                new RussianFormat(),
                '05.09.2010 13:33:31',
            ],
            'international date format for datetime (05.09.2010 13:33:31) - 05-09-2010' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new InternationalFormat(),
                '05-09-2010 13:33:31',
            ],
            'usa date format for datetime (05.09.2010 13:33:31) - 2010/09/05' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new UsaFormat(),
                '09-05-2010 13:33:31',
            ],

        ];
    }
}
