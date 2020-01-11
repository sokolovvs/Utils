<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsFilterNumericTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->filterNumeric($number));
    }

    public function dataProvide(): array
    {
        return [
            '10 is number' => [10, 10],
            'PHP_INT_MIN is number' => [PHP_INT_MIN, PHP_INT_MIN],
//            'PHP_INT_MIN - 1 is not number' => [PHP_INT_MIN - 1, PHP_INT_MIN - 1], //TODO: need fix
            '\'-356\' is number' => ['-356', -356],
            '-56.232 is not number' => [-56.232, -56.232],
            'NULL is not number' => [null, null],
            'Object is not number' => [new \stdClass(), null],
            'Array is not number' => [[], null],
            'String \'some string\' is not number' => ['some string', null],
            'String \'-1life\' is not number' => ['1life', null],
            '0 is number' => [0, 0],
        ];
    }
}
