<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsGetNotPositiveNumberOrNullTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->getNotPositiveNumberOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is positive ' => [1, null],
            'PHP_INT_MIN is negative ' => [PHP_INT_MIN, PHP_INT_MIN],
            //            'PHP_INT_MIN -1 is not ' => [PHP_INT_MIN - 1, null], // TODO: need fix
            '\'-356\' is  string with  form' => ['-356', -356],
            '-56.232 is not ' => [-56.232, -56.232],
            'NULL is not ' => [null, null],
            'Object is not ' => [new \stdClass(), null],
            'Array is not ' => [[], null],
            'String \'some string\' is not ' => ['some string', null],
            'String \'1life\' is not ' => ['1life', null],
            '-44 is not positive' => [-44, -44],
            '0 is not positive' => [0, 0],
        ];
    }
}
