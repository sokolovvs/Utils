<?php


namespace Tests\Unit\BooleanAdapter;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\BooleanAdapter\BooleanAdapter;

class BooleanAdapterToBooleanTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     *
     * @param $value
     * @param $expected
     */
    public function test($value, $expected): void
    {
        $this->assertSame($expected, BooleanAdapter::toBoolean($value));
    }

    public function dataProvide(): array
    {
        return [
            'false -> false' => [false, false],
            'true -> true' => [true, true],
            'null -> false' => [null, false],
            '"" -> false' => ['', false],
            '" " -> false' => [' ', false],
            '" g " -> true' => [' g ', true],
            '"false" -> false' => ['false', false],
            '"    false    " -> false' => ['    false    ', false],
            '"    false  true  " -> false' => ['    false  true  ', true],
            '"true" -> true' => ['true', true],
            '"   true    " -> true' => ['   true    ', true],
            '"null" -> false' => ['null', false],
            '"     null    " -> false' => ['     null    ', false],
            '[] -> false' => [[], false],
            '[0] -> true' => [[0], true],
            '[1] -> true' => [[1], true],
            'stdClass -> true' => [new \stdClass(), true],
            '1 -> true' => [1, true],
            '"1" -> true' => ['1', true],
            '"   1   " -> true' => ['   1   ', true],
            '0 -> false' => [0, false],
            '"0" -> false' => ['0', false],
            '"   0   " -> false' => ['   0   ', false],
            '"    0  0  " -> true' => ['    0  0  ', true],
            '23 -> true' => [23, true],
            '-23 -> true' => [-23, true],
            '1e-100 -> true' => [1e-100, true],
            '"some words" -> true' => ['lalala', true],
            '"{}" -> false' => ['{}', false],
            '"{0: 0}" -> true' => ['{0: 0}', true],
            '"{"gfg": "gfg"}" -> true' => ['{0: 0}', true],
            '"{0: 0" -> true' => ['{0: 0', true],
            'function() { return true; } -> true' => [
                function () {
                    return true;
                },
                true,
            ],
            'function() { return false; } -> true' => [
                function () {
                    return false;
                },
                true,
            ],
        ];
    }
}
