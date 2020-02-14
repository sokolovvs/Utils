<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsTimezoneExistTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($timezone, $expected): void
    {
        $this->assertSame($expected, DateTimeUtils::timezoneExists($timezone));
    }

    public function dataProvide(): array
    {
        return [
            'timezone is exist' => ['Asia/Omsk', true],
            'timezone is not exist' => ['Omsk/Omsk', false],
            'timezone is empty str' => ['', false],
        ];
    }
}
