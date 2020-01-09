<?php


namespace Tests\Unit\ArrayUtils;


class ArrayEqualsTest extends ArrayUtilsTest
{
    public function testEmptyArrayMustEqualsEmptyArray(): void
    {
        $this->assertTrue($this->arrayUtils->equals([], []));
    }

    public function testArrayMustEqualsArray(): void
    {
        $this->assertTrue($this->arrayUtils->equals([1, 2, 3], [1, 2, 3]));
        $this->assertTrue($this->arrayUtils->equals(['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    public function testArrayMustNotEqualsArrayWithDifferentOrder(): void
    {
        $this->assertFalse($this->arrayUtils->equals([1, 2, 3], [1, 3, 2]));
    }

    public function testArrayMustNotEqualsAnotherArrayIfAnotherArraySizeSmaller(): void
    {
        $this->assertFalse($this->arrayUtils->equals(['a' => 1, 'b' => 2, 'c' => 3], ['a' => 1, 'b' => 2]));
    }
}
