<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetPositiveIntegerOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::getPositiveIntegerOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is positive int' => [1, 1],
            'PHP_INT_MAX is positive int' => [PHP_INT_MAX, PHP_INT_MAX],
            'PHP_INT + 1 is not int' => [PHP_INT_MAX + 1, null],
            '\'356\' is not int' => ['356', 356],
            '56.232 is not int' => [56.232, null],
            'NULL is not int' => [null, null],
            'Object is not int' => [new \stdClass(), null],
            'Array is not int' => [[], null],
            'String \'some string\' is not int' => ['some string', null],
            'String \'1life\' is not int' => ['1life', null],
            '-44 is not positive' => [-44, null],
            '0 is not positive' => [0, null],
        ];
    }
}
