<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsTimezoneExistTest extends DateTimeUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($timezone, $expected): void
    {
        $this->assertSame($expected, $this->dateTimeUtils->timezoneExists($timezone));
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
