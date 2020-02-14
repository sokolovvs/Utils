<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetNegativeIntegerOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::getNegativeIntegerOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '11 is not negative int' => [11, null],
            'PHP_INT_MAX is negative int' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN - 1 is not int' => [PHP_INT_MIN - 1, null],
            '\'-356\' is negative int' => ['-356', -356],
            '-56.232 is not int' => [-56.232, null],
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
