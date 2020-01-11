<?php


namespace Tests\Unit\RangeUtils\RangeDateTime;


use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\RangeUtils\RangeDateTime;

class RangeDateTimeTest extends TestCase
{
    /**
     * @dataProvider dataProvideForIsValid
     *
     * @param bool          $expected
     * @param RangeDateTime $range
     */
    public function testIsValid(bool $expected, RangeDateTime $range): void
    {
        $this->assertSame($expected, $range->isValid());
    }

    public function dataProvideForIsValid(): array
    {
        return [
            'if $from <= $to => is valid' => [
                true,
                new RangeDateTime(
                    new DateTime('01.04.2019 08:38:10'), new DateTimeImmutable('01.04.2019 09:38:10')
                ),
            ],
            'if $from > $to => is invalid' => [
                false,
                new RangeDateTime(
                    new DateTime('01.05.2019 08:38:10'), new DateTimeImmutable('01.04.2019 09:38:10')
                ),
            ],
            'if $from == $to => is valid' => [
                true,
                new RangeDateTime(
                    new DateTime('01.04.2019 08:38:10'), new DateTimeImmutable('01.04.2019 08:38:10')
                ),
            ],
        ];
    }

    /**
     * @dataProvider dataProvideForValueFromIsEquivalentTo
     *
     * @param bool          $expected
     * @param RangeDateTime $range
     */
    public function testValueFromIsEquivalentTo(bool $expected, RangeDateTime $range): void
    {
        $this->assertSame($expected, $range->valueFromIsEquivalentTo());
    }

    public function dataProvideForValueFromIsEquivalentTo(): array
    {
        return [
            'if $from <= $to => is valid' => [
                false,
                new RangeDateTime(
                    new DateTime('01.04.2019 08:38:10'), new DateTimeImmutable('01.04.2019 09:38:10')
                ),
            ],
            'if $from > $to => is invalid' => [
                false,
                new RangeDateTime(
                    new DateTime('01.05.2019 08:38:10'), new DateTimeImmutable('01.04.2019 09:38:10')
                ),
            ],
            'if $from == $to => is valid' => [
                true,
                new RangeDateTime(
                    new DateTime('01.04.2019 08:38:10'), new DateTimeImmutable('01.04.2019 08:38:10')
                ),
            ],
        ];
    }

    /**
     * @dataProvider dataProvideForRevert
     */
    public function testRevert($from, $to): void
    {
        $range = new RangeDateTime(
            new DateTime($from), new DateTimeImmutable($to)
        );

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
            '$from must will be $to and $to must will be $from' => [
                '01.05.2019 08:38:10',
                '01.04.2019 09:38:10',
            ],
        ];
    }

    /**
     * @dataProvider dataProvideForToArray
     *
     * @param RangeDateTime $range
     */
    public function testToArray(RangeDateTime $range): void
    {
        $this->assertSame(['from' => $range->getFrom(), 'to' => $range->getTo()], $range->toArray());
    }

    public function dataProvideForToArray(): array
    {
        return [
            '$from must will be $to and $to must will be $from' => [
                new RangeDateTime(
                    new DateTime('01.05.2019 08:38:10'), new DateTimeImmutable('01.04.2019 09:38:10')
                ),
            ],
        ];
    }

    /**
     * @dataProvider dataProvideForContains
     *
     * @param bool              $expected
     * @param RangeDateTime     $range
     * @param DateTimeInterface $value
     */
    public function testContains(bool $expected, RangeDateTime $range, DateTimeInterface $value): void
    {
        $this->assertSame($expected, $range->contains($value));
    }

    public function dataProvideForContains(): array
    {
        return [
            'range [01.01.2000, 01.01.2005] is contains 01.01.2003' => [
                true,
                new RangeDateTime(new DateTimeImmutable('01.01.2000'), new DateTime('01.01.2005')),
                new DateTimeImmutable('01.01.2003'),
            ],
            'range [01.01.2000, 01.01.2005] is not contains 01.01.1930' => [
                false,
                new RangeDateTime(new DateTimeImmutable('01.01.2000'), new DateTime('01.01.2005')),
                new DateTimeImmutable('01.01.1930'),
            ],
            'range [01.01.2000, 01.01.2000] is contains 01.01.2000' => [
                true,
                new RangeDateTime(new DateTimeImmutable('01.01.2000'), new DateTime('01.01.2005')),
                new DateTimeImmutable('01.01.2003'),
            ],
        ];
    }

    public function testContainsFail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Parameter $value must be type DateTimeInterface');
        $range = new RangeDateTime(new DateTimeImmutable('01.01.2000'), new DateTime('01.01.2005'));
        $range->contains(-1);
    }

    public function testJsonSerializableEqualToArray()
    {
        $range = new RangeDateTime(new DateTime('now'), new DateTime('now'));
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
        $this->assertEquals($expected, RangeDateTime::createFromArray($array)->toArray());
    }

    public function dataProvideForCreateFromArray(): array
    {
        $from = new DateTime('2019/01/29');
        $to = new DateTimeImmutable('now');

        return [
            'create via associative array' => [
                ['from' => $from, 'to' => $to],
                ['from' => $from, 'to' => $to],
            ],
            'create via not associative array' => [
                ['from' => $from, 'to' => $to],
                [$from, $to],
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
        RangeDateTime::createFromArray($array)->toArray();
    }

    public function dataProvideForCreateFromArrayFail(): array
    {
        return [
            'create via array with size 1' => [
                [new DateTimeImmutable('2001/06/29')],
            ],
            'create via array with size 3' => [
                [
                    'from' => new DateTimeImmutable('2001/06/29'),
                    'to' => new DateTimeImmutable('2001/06/29'),
                    'middle' => new DateTimeImmutable('2001/06/29'),
                ],
            ],
            'create via array with size 0' => [
                [],
            ],
        ];
    }
}
