<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsFilterIntegerTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::filterInteger($number));
    }

    public function dataProvide(): array
    {
        return [
            '10 is int' => [10, 10],
            'PHP_INT_MIN is int' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN - 1 is not int' => [PHP_INT_MIN - 1, null],
            '\'-356\' is int' => ['-356', -356],
            '-56.232 is not int' => [-56.232, null],
            'NULL is not int' => [null, null],
            'Object is not int' => [new \stdClass(), null],
            'Array is not int' => [[], null],
            'String \'some string\' is not int' => ['some string', null],
            'String \'-1life\' is not int' => ['1life', null],
            '0 is int' => [0, 0],
        ];
    }
}
