<?php


namespace Tests\Unit\NumberUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\NumberUtils\NumberUtils;

class NumberUtilsIsEvenTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     *
     * @param  int   $number
     * @param  bool  $expected
     */
    public function test(int $number, bool $expected): void
    {
        $this->assertSame($expected, NumberUtils::isEven($number));
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
