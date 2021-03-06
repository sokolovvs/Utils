<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsNegativeNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::isNegativeNum($number));
    }

    public function dataProvide(): array
    {
        return [
            '10 is not negative' => [10, false],
            'PHP_INT_MIN is negative' => [PHP_INT_MIN, true],
            'PHP_INT_MIN - 1 is negative  ' => [PHP_INT_MIN - 1, true],
            '\'-356\' is negative ' => ['-356', -356],
            '-56.232 is not ' => [-56.232, true],
            'NULL is not ' => [null, false],
            'Object is not ' => [new \stdClass(), false],
            'Array is not ' => [[], false],
            'String \'some string\' is not ' => ['some string', false],
            'String \'-1life\' is not ' => ['1life', false],
            '-44 is negative' => [-44, true],
            '0 is not negative' => [0, false],
        ];
    }
}
