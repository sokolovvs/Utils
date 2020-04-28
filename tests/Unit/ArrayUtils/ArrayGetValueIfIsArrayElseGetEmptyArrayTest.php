<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;

class ArrayGetValueIfIsArrayElseGetEmptyArrayTest extends ArrayUtilsTest
{
    public function testIfValueIsArrayMustReturnValue(): void
    {
        $this->assertEquals([], ArrayUtils::castToArray([]));
        $this->assertEquals([1, 2, 'g', null], ArrayUtils::castToArray([1, 2, 'g', null]));
    }

    public function testIfValueIsNotArrayMustReturnEmptyArray(): void
    {
        $this->assertEquals([], ArrayUtils::castToArray(null));
        $this->assertEquals([], ArrayUtils::castToArray(new \stdClass()));
        $this->assertEquals([], ArrayUtils::castToArray(1));
        $this->assertEquals([], ArrayUtils::castToArray(1.01));
        $this->assertEquals([], ArrayUtils::castToArray('assa'));
    }
}
