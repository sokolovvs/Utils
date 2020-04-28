<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetPositiveNumberOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::castToPositiveNum($number));
    }

    public function dataProvide(): array
    {
        return [
            '132 is positive number' => [132, 132],
            'PHP_INT_MAX is positive number' => [PHP_INT_MAX, PHP_INT_MAX],
            'PHP_INT_MAX + 1 is positive' => [
                sprintf('%.13f', PHP_INT_MAX + 1),
                sprintf('%.13f', PHP_INT_MAX + 1),
            ],
            '\'356.1121\' is positive number' => ['356.1121', 356.1121],
            '56.232 is positive number' => [56.232, 56.232],
            'NULL is not number' => [null, null],
            'Object is not number' => [new \stdClass(), null],
            'Array is not number' => [[], null],
            'String \'some string\' is not number' => ['some string', null],
            'String \'1life\' is not number' => ['1life', null],
            '-44 is not positive' => [-44, null],
            '0 is not positive' => [0, null],
        ];
    }
}
