<?php

namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsOddTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     *
     * @param  int   $number
     * @param  bool  $expected
     */
    public function test(int $number, bool $expected): void
    {
        $this->assertSame($expected, NumberUtils::isOdd($number));
    }

    public function dataProvide(): array
    {
        return [
            '3 is odd' => [3, true],
            '-11 is odd' => [-11, true],
            '0 is not odd' => [-0, false],
            '2 is not odd' => [2, false],
        ];
    }
}
