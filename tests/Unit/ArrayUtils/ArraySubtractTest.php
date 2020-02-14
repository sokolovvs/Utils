<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;
use Tests\Support\TestData\ClassWithToString;

class ArraySubtractTest extends ArrayUtilsTest
{
    public function testEmptyArrayMinusEmptyArrayEqualsEmptyArray(): void
    {
        $this->assertEmpty(ArrayUtils::subtract([], []));
    }

    public function testEmptyArrayMinusRandArrayEqualsEmptyArray(): void
    {
        $this->assertEmpty(ArrayUtils::subtract([], $this->randArray));
    }

    public function testRandArrayEqualsMinusEmptyArrayEqualsRandArray(): void
    {
        $this->assertEquals($this->randArray, ArrayUtils::subtract($this->randArray, []));
    }

    public function testRandArrayMinusRandArrayMustEqualsEmptyArray(): void
    {
        $this->assertEmpty(ArrayUtils::subtract($this->randArray, $this->randArray));
    }

    public function testResultArrayMustContainsOnly3(): void
    {
        $nine = new ClassWithToString('9');

        $this->assertEquals([3], ArrayUtils::subtract([1, 2, 3], [2, 1]));
        $this->assertEquals([3], ArrayUtils::subtract([1, 3, 1, 2, 9], [5, 6, 7, 8, '2', 1, 1, 1, 1, 4, $nine]));
    }

    public function testArrayMinusArrayMustEqualsEmptyArray(): void
    {
        $a = new ClassWithToString();
        $aa = new ClassWithToString();

        $array = [$aa, $a];
        $otherArray = [$a];

        $this->assertEmpty(ArrayUtils::subtract($array, $otherArray));
    }
}
