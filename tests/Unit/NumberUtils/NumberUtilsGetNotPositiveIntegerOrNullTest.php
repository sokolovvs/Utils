<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsGetNotPositiveIntegerOrNullTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertEquals($expected, NumberUtils::getNotPositiveIntegerOrNull($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is positive int' => [1, null],
            'PHP_INT_MIN is negative int' => [PHP_INT_MIN, PHP_INT_MIN],
            'PHP_INT_MIN -1 is not int' => [PHP_INT_MIN - 1, null],
            '\'-356\' is  string with int form' => ['-356', -356],
            '-56.232 is not int' => [-56.232, null],
            'NULL is not int' => [null, null],
            'Object is not int' => [new \stdClass(), null],
            'Array is not int' => [[], null],
            'String \'some string\' is not int' => ['some string', null],
            'String \'1life\' is not int' => ['1life', null],
            '-44 is not positive' => [-44, -44],
            '0 is not positive' => [0, 0],
        ];
    }
}
