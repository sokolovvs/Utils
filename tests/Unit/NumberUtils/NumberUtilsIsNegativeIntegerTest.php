<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsNegativeIntegerTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::isNegativeInt($number));
    }

    public function dataProvide(): array
    {
        return [
            '10 is not negative int' => [10, false],
            'PHP_INT_MAX is negative int' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN - 1 is not int' => [PHP_INT_MIN - 1, false],
            '\'-356\' is negative int' => ['-356', -356],
            '-56.232 is not int' => [-56.232, false],
            'NULL is not int' => [null, false],
            'Object is not int' => [new \stdClass(), false],
            'Array is not int' => [[], false],
            'String \'some string\' is not int' => ['some string', false],
            'String \'-1life\' is not int' => ['1life', false],
            '44 is not negative' => [44, false],
            '0 is not negative' => [0, false],
        ];
    }
}
