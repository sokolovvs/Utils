<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsFilterNumericTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::filterNumeric($number));
    }

    public function dataProvide(): array
    {
        return [
            '10 is number' => [10, 10],
            'PHP_INT_MIN is number' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN - 1 is number' => [
                sprintf('%.13f', PHP_INT_MIN - 1),
                sprintf('%.13f', PHP_INT_MIN - 1),
            ],
            '\'-356\' is number' => ['-356', -356],
            '-56.232 is not number' => [-56.232, -56.232],
            'NULL is not number' => [null, null],
            'Object is not number' => [new \stdClass(), null],
            'Array is not number' => [[], null],
            'String \'some string\' is not number' => ['some string', null],
            'String \'-1life\' is not number' => ['1life', null],
            '0 is number' => [0, 0],
        ];
    }
}
