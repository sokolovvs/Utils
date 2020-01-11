<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsIsNotPositiveNumberTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, $this->numberUtils->isNotPositiveNumber($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is positive ' => [1, false],
            'PHP_INT_MIN is not positive ' => [PHP_INT_MIN, PHP_INT_MIN],
            //            'PHP_INT_MIN -1 is not ' => [PHP_INT_MIN - 1, false], // TODO: need fix
            '\'-356\' is  string with  form int' => ['-356', true],
            '-56.232 is not ' => [-56.232, true],
            'NULL is not ' => [null, false],
            'Object is not ' => [new \stdClass(), false],
            'Array is not ' => [[], false],
            'String \'some string\' is not ' => ['some string', false],
            'String \'1life\' is not ' => ['1life', false],
            '-44 is not positive' => [-44, true],
            '0 is not positive' => [0, true],
        ];
    }
}
