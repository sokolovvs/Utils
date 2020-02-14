<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsNotNegativeNumberOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::isNotNegativeNumber($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 >= 0 -> true' => [1, true],
            'PHP_INT_MIN <= 0 -> null' => [PHP_INT_MIN, false],
            'PHP_INT_MAX + 1 => 0 -> PHP_INT_MAX + 1' => [PHP_INT_MAX + 1, true],
            '\'356\' >= 0 -> true' => ['356.327', true],
            '-56.232 is not int' => [-56.232, false],
            'NULL is not int -> null' => [null, false],
            'Object is not int -> null' => [new \stdClass(), false],
            'Array is not int -> null' => [[], false],
            'String \'some string\' is not int -> null' => ['some string', false],
            'String \'1life\' is not int -> null' => ['1life', false],
            '-44 >= 0 -> true' => [-44, false],
            '0 >= 0 -> true' => [0, true],
        ];
    }
}
