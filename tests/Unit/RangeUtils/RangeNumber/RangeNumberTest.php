<?php


namespace Tests\Unit\RangeUtils\RangeNumber;


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\RangeUtils\RangeNumber;

class RangeNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvideForIsValid
     *
     * @param bool $expected
     */
    public function testIsValid(bool $expected, $from, $to): void
    {
        $range = new RangeNumber($from, $to);

        $this->assertSame($expected, $range->isValid());
    }

    public function dataProvideForIsValid(): array
    {
        return [
            'if $from <= $to => is valid' => [true, -1, 40.54],
            'if $from > $to => is invalid' => [false, -123, -13209.3],
            'if $from == $to => is valid' => [true, 0, 0],
        ];
    }

    /**
     * @dataProvider dataProvideForValueFromIsEquivalentTo
     *
     * @param bool $expected
     */
    public function testValueFromIsEquivalentTo(bool $expected, $from, $to): void
    {
        $range = new RangeNumber($from, $to);

        $this->assertSame($expected, $range->valueFromIsEquivalentTo());
    }

    public function dataProvideForValueFromIsEquivalentTo(): array
    {
        return [
            'if $from <= $to => is valid' => [false, -1, 10.45],
            'if $from > $to => is invalid' => [false, -123, -13209.3],
            'if $from == $to => is valid' => [true, 0, 0],
        ];
    }

    /**
     * @dataProvider dataProvideForRevert
     *
     * @param RangeNumber $range
     */
    public function testRevert(RangeNumber $range): void
    {
        $oldFrom = $range->getFrom();
        $oldTo = $range->getTo();
        $range->revert();
        $newFrom = $range->getFrom();
        $newTo = $range->getTo();
        $revertCheck = $oldFrom === $newTo && $oldTo === $newFrom;

        $this->assertTrue($revertCheck);
    }

    public function dataProvideForRevert(): array
    {
        return [
            '$from must will be $to and $to must will be $from' => [new RangeNumber(-1, 10.45)],
        ];
    }

    /**
     * @dataProvider dataProvideForToArray
     *
     * @param RangeNumber $range
     */
    public function testToArray(RangeNumber $range): void
    {
        $this->assertSame(['from' => $range->getFrom(), 'to' => $range->getTo()], $range->toArray());
    }

    public function dataProvideForToArray(): array
    {
        return [
            '$from must will be $to and $to must will be $from' => [
                new RangeNumber(10.34, 0.5569),
            ],
        ];
    }

    public function testCreateFail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Parameters $from and $to must be numeric');
        new RangeNumber(4, 'Parameters $from and $to must be numeric');
    }

    /**
     * @dataProvider dataProvideForContains
     *
     * @param RangeNumber $range
     */
    public function testContains($expected, RangeNumber $range, $value): void
    {
        $this->assertSame($expected, $range->contains($value));
    }

    public function dataProvideForContains(): array
    {
        return [
            'range [0, 1] is contains 0.5' => [
                true,
                new RangeNumber(0, 1),
                0.5,
            ],
            'range [0, 1] is not contains 0.5' => [
                false,
                new RangeNumber(0, 1),
                -0.5,
            ],
            'range [0, 0] is contains 0' => [
                true,
                new RangeNumber(0, 0),
                0,
            ],
        ];
    }

    public function testContainsFail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Parameter $value must be type float or double or integer');
        $range = new RangeNumber(4, 5);
        $range->contains([]);
    }

    public function testJsonSerializableEqualToArray()
    {
        $range = new RangeNumber(-1, 1);
        $this->assertSame($range->toArray(), $range->jsonSerialize());
    }

    /**
     * @dataProvider dataProvideForCreateFromArray
     *
     * @param array $expected
     * @param array $array
     */
    public function testCreateFromArray(array $expected, array $array): void
    {
        $this->assertEquals($expected, RangeNumber::createFromArray($array)->toArray());
    }

    public function dataProvideForCreateFromArray(): array
    {
        return [
            'create via associative array' => [
                ['from' => 1012.34, 'to' => 2434],
                ['from' => 1012.34, 'to' => 2434],
            ],
            'create via not associative array' => [
                ['from' => 54, 'to' => -67.0],
                [54, -67.0],
            ],
        ];
    }

    /**
     * @dataProvider dataProvideForCreateFromArrayFail
     *
     * @param array $array
     */
    public function testCreateFromArrayFail(array $array): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Parameter $range must has type array and size of $range == 2');
        RangeNumber::createFromArray($array)->toArray();
    }

    public function dataProvideForCreateFromArrayFail(): array
    {
        return [
            'create via array with size 1' => [
                [1],
            ],
            'create via array with size 3' => [
                ['from' => 54, 'to' => 67, 'middle' => 59],
            ],
            'create via array with size 0' => [
                [],
            ],
        ];
    }
}
