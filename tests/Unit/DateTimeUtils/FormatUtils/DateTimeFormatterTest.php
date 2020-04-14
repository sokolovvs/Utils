<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils;


use DateTime;
use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\DateTimeFormatter;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalDateFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalDateTimeFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\RussianDateFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\RussianDateTimeFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaDateFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaDateTimeFormat;

class DateTimeFormatterTest extends TestCase
{

    /**
     * @dataProvider dataProvide
     */
    public function testDateToFormat($dateTime, $format, $expected): void
    {
        $this->assertSame($expected, DateTimeFormatter::format($dateTime, $format));
    }

    public function dataProvide(): array
    {
        return [
            'russian date format for date (2010/09/05 13:33:31) - 05.09.2010' => [
                new DateTime(
                    '2010/09/05 13:33:31'
                ),
                new RussianDateFormat(),
                '05.09.2010',
            ],
            'international date format for date (05.09.2010 13:33:31) - 05-09-2010' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new InternationalDateFormat(),
                '05-09-2010',
            ],
            'usa date format for date (05.09.2010 13:33:31) - 2010/09/05' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new UsaDateFormat(),
                '09-05-2010',
            ],
            'russian date format for datetime (2010/09/05 13:33:31) - 05.09.2010 13:33:31' => [
                new DateTime(
                    '2010/09/05 13:33:31'
                ),
                new RussianDateTimeFormat(),
                '05.09.2010 13:33:31',
            ],
            'international date format for datetime (05.09.2010 13:33:31) - 05-09-2010' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new InternationalDateTimeFormat(),
                '05-09-2010 13:33:31',
            ],
            'usa date format for datetime (05.09.2010 13:33:31) - 2010/09/05' => [
                new DateTime(
                    '05.09.2010 13:33:31'
                ),
                new UsaDateTimeFormat(),
                '09-05-2010 13:33:31',
            ],
        ];
    }
}
