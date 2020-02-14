<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;

class ArrayEqualsTest extends ArrayUtilsTest
{
    public function testEmptyArrayMustEqualsEmptyArray(): void
    {
        $this->assertTrue(ArrayUtils::equals([], []));
    }

    public function testArrayMustEqualsArray(): void
    {
        $this->assertTrue(ArrayUtils::equals([1, 2, 3], [1, 2, 3]));
        $this->assertTrue(ArrayUtils::equals(['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    public function testArrayMustNotEqualsArrayWithDifferentOrder(): void
    {
        $this->assertFalse(ArrayUtils::equals([1, 2, 3], [1, 3, 2]));
    }

    public function testArrayMustNotEqualsAnotherArrayIfAnotherArraySizeSmaller(): void
    {
        $this->assertFalse(ArrayUtils::equals(['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2]));
    }
}
