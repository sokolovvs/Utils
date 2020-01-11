<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsGetNegativeNumberOrNullTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->getNegativeNumberOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '113 is not negative int' => [113, null],
            'PHP_INT_MAX is negative int' => [PHP_INT_MIN, PHP_INT_MIN],
//            'PHP_INT_MIN - 1 is not int' => [PHP_INT_MIN - 1, null], //TODO: need fix
            '\'-356\' is negative int' => ['-356', -356],
            '-56.232 is not int' => [-56.232, -56.232],
            'NULL is not int' => [null, null],
            'Object is not int' => [new \stdClass(), null],
            'Array is not int' => [[], null],
            'String \'some string\' is not int' => ['some string', null],
            'String \'-1life\' is not int' => ['1life', null],
            '44 is not negative' => [44, null],
            '0 is not negative' => [0, null],
        ];
    }
}
