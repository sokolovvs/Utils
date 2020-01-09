<?php


namespace Tests\Unit\NumberUtils;


class NumberUtilsIsEvenTest extends NumberUtilsTest
{
    /**
     * @dataProvider dataProvide
     *
     * @param  int   $number
     * @param  bool  $expected
     */
    public function test(int $number, bool $expected): void
    {
        $this->assertSame($expected, $this->numberUtils->isEven($number));
    }

    public function dataProvide(): array
    {
        return [
            '3 is not even' => [3, false],
            '-11 is not even' => [-11, false],
            '0 is even' => [-0, true],
            '2 is even' => [2, true],
        ];
    }
}
