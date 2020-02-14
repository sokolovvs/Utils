<?php


namespace Tests\Unit\DateTimeUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\DateTimeUtils;

class DateTimeUtilsGetTimezoneIfExistTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($timezone, $expected): void
    {
        $this->assertEquals($expected, DateTimeUtils::getTimezoneIfExists($timezone));
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
