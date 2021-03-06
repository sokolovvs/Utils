<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetNotPositiveNumberOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::castToNotPositiveNum($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is positive ' => [1, null],
            'PHP_INT_MIN is negative ' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN - 1 is not ' => [
                sprintf('%.13f', PHP_INT_MIN - 1),
                sprintf('%.13f', PHP_INT_MIN - 1),
            ],
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
