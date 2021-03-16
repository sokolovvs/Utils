<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;
use Tests\Support\TestData\Email;

class ArrayIsSubsetOfTest extends ArrayUtilsTest
{
    /**
     * @dataProvider dataProvide
     *
     * @param bool          $expected
     * @param iterable      $set
     * @param iterable      $subset
     * @param callable|null $comparator
     */
    public function test(bool $expected, iterable $set, iterable $subset, ?callable $comparator = null)
    {
        self::assertSame($expected, ArrayUtils::isSubsetOf($subset, $set, $comparator));
    }

    public function dataProvide()
    {
        $emailComparator = new class {
            public function compare(Email $item, Email $otherItem)
            {
                return mb_strlen($item->getValue()) === mb_strlen($otherItem->getValue());
            }
        };

        return [
            [false, [5, 6, 7], [9, 3]],
            [false, [9, 3,], [9, 1,]],
            [true, [9, 3,], [9, 3,]],
            [true, [9, 3, 1, 1, 2], [9, 3,]],
            [true, [3, 9], [3, 9]],
            [false, [], [3, 9]],
            [true, [5, 6], [],],
            [
                true,
                [new Email('example@example.com'), new Email('example@example.net'),],
                [new Email('EXAMPLE@EXAMPLE.COM'),],
                [$emailComparator, 'compare'],
            ],
        ];
    }
}
