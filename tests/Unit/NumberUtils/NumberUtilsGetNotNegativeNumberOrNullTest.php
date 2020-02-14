<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetNotNegativeNumberOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::getNotNegativeNumberOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 >= 0 -> number' => [1, 1],
            'PHP_INT_MIN <= 0 -> null' => [PHP_INT_MIN, null],
            'PHP_INT_MAX + 1 => 0 -> PHP_INT_MAX + 1' => [
                sprintf('%.13f', PHP_INT_MAX + 1),
                sprintf('%.13f', PHP_INT_MAX + 1),
            ],
            '\'356\' >= 0 -> number' => ['356.327', 356.327],
            '-56.232 is not int' => [-56.232, null],
            'NULL is not int -> null' => [null, null],
            'Object is not int -> null' => [new \stdClass(), null],
            'Array is not int -> null' => [[], null],
            'String \'some string\' is not int -> null' => ['some string', null],
            'String \'1life\' is not int -> null' => ['1life', null],
            '-44 >= 0 -> number' => [-44, null],
            '0 >= 0 -> number' => [0, 0],
        ];
    }
}
