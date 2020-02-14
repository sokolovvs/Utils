<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsToFixedTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $precision, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::toFixed($number, $precision));
    }

    public function dataProvide(): array
    {
        return [
            'toFixed(10.01234567890, 5)' => [10.01234567890, 5, 10.01234],
            'toFixed(\'is not number\', 5)' => ['is not number', 5, null],
        ];
    }
}
