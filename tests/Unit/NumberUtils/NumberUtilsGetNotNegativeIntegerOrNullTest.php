<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsGetNotNegativeIntegerOrNullTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->getNotNegativeIntegerOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is  not negative int' => [1, 1],
            'PHP_INT_MAX is not negative int' => [PHP_INT_MAX, PHP_INT_MAX],
            'PHP_INT + 1 is not int' => [PHP_INT_MAX + 1, null],
            '\'356\' is not negative int' => ['356', 356],
            '56.232 is not int' => [56.232, null],
            'NULL is not int' => [null, null],
            'Object is not int' => [new \stdClass(), null],
            'Array is not int' => [[], null],
            'String \'some string\' is not int' => ['some string', null],
            'String \'1life\' is not int' => ['1life', null],
            '-44 is not positive' => [-44, null],
            '0 is not negative' => [0, 0],
        ];
    }
}
