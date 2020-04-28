<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsNotNegativeIntegerTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($number, $expected): void
    {
        $this->assertSame($expected, NumberUtils::isNotNegativeInt($number));
    }

    public function dataProvide(): array
    {
        return [
            '1 is  not negative int' => [1, true],
            'PHP_INT_MAX is not negative int' => [PHP_INT_MAX, true],
            'PHP_INT + 1 is not int' => [PHP_INT_MAX + 1, false],
            '\'356\' is not negative int' => ['356', true],
            '56.232 is not int' => [56.232, false],
            'NULL is not int' => [null, false],
            'Object is not int' => [new \stdClass(), false],
            'Array is not int' => [[], false],
            'String \'some string\' is not int' => ['some string', false],
            'String \'1life\' is not int' => ['1life', false],
            '-44 is not positive' => [-44, false],
            '0 is not negative' => [0, true],
        ];
    }
}
