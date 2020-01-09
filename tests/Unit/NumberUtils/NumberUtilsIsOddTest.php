<?php

namespace Tests\Unit\NumberUtils;


class NumberUtilsIsOddTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     *
     * @param  int   $number
     * @param  bool  $expected
     */
    public function test(int $number, bool $expected): void
    {
        $this->assertSame($expected, $this->numberUtils->isOdd($number));
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
