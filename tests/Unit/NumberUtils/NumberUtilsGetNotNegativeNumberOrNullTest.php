<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsGetNotNegativeNumberOrNullTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->getNotNegativeNumberOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 >= 0 -> number' => [1, 1],
            'PHP_INT_MIN <= 0 -> null' => [PHP_INT_MIN, null],
//            'PHP_INT_MAX + 1 => 0 -> HP_INT_MAX + 1' => [PHP_INT_MAX + 1, null], // TODO: fix
            '\'356\' >= 0 -> number' => ['356.327', 356.327],
            '-56.232 is not int' => [-56.232, null],
            'NULL is not int -> null' => [null, null],
            'Object is not int -> null' => [new \stdClass(), null],
            'Array is not int -> null' => [[], null],
            'String \'some string\' is not int -> null' => ['some string', null],
            'String \'1life\' is not int -> null' => ['1life', null],
            '-44 >= 0 -> number' => [-44, null],
            '0 >= 0 -> number' => [0, 0],
        ];
    }
}
