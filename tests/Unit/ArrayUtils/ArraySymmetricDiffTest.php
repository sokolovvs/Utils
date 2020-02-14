<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;
use Tests\Support\TestData\ClassWithToString;

class ArraySymmetricDiffTest extends ArrayUtilsTest
{
    public function testSymmetricDiffForEmptyArrayAndEmptyArrayEqualsEmptyArray(): void
    {
        $this->assertEmpty(ArrayUtils::symmetricDiff([], []));
    }

    public function testSymmetricDiffForRandArrayAndEmptyArrayEqualsRandArray(): void
    {
        $this->assertEquals($this->randArray, ArrayUtils::symmetricDiff($this->randArray, []));
    }

    public function testSymmetricDiffForEmptyArrayAndRandArrayEqualsRandArray(): void
    {
        $this->assertEquals($this->randArray, ArrayUtils::symmetricDiff([], $this->randArray));
    }

    public function testSymmetricDiffForRandArrayAndRandArrayEqualsEmptyArray(): void
    {
        $this->assertEmpty(ArrayUtils::symmetricDiff($this->randArray, $this->randArray));
    }

    public function testResultArrayMustContainsOnly3And10(): void
    {
        $nine = new ClassWithToString('9');

        $expected = [3, 10];
        $actual = ArrayUtils::symmetricDiff([1, 3, 2], [2, 1, 10]);
        sort($expected);
        sort($actual);
        $this->assertEquals($expected, $actual);

        $expected = [3, 10];
        $actual = ArrayUtils::symmetricDiff([1, 3, 1, 2, 9], ['2', 1, 1, 1, 1, $nine, 10]);
        sort($expected);
        sort($actual);
        $this->assertEquals($expected, $actual);

        $expected = [3, 10];
        $actual = ArrayUtils::symmetricDiff(['2', 1, 1, 1, 1, $nine, 10], [1, 3, 1, 2, 9]);
        sort($expected);
        sort($actual);
        $this->assertEquals($expected, $actual);
    }

    public function testArrayMinusArrayMustEqualsEmptyArray(): void
    {
        $a = new ClassWithToString();
        $aa = new ClassWithToString();

        $array = [$aa, $a];
        $otherArray = [$a];

        $this->assertEmpty(ArrayUtils::symmetricDiff($array, $otherArray));
    }
}
