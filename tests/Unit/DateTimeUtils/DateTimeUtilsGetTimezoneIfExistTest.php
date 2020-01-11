<?php


namespace Tests\Unit\DateTimeUtils;


class DateTimeUtilsGetTimezoneIfExistTest extends DateTimeUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($timezone, $expected): void
    {
        $this->assertEquals($expected, $this->dateTimeUtils->getTimezoneIfExists($timezone));
    }

    public function dataProvide(): array
    {
        return [
            'timezone is exist' => ['Asia/Omsk', new \DateTimeZone('Asia/Omsk')],
            'timezone is not exist' => ['Omsk/Omsk', null],
            'timezone is empty str' => ['', null],
        ];
    }
}
