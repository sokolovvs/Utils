<?php


namespace Tests\Unit\ArrayUtils;


use Sokolovvs\Utils\ArrayUtils\ArrayUtils;

class ArrayGetValueIfIsArrayElseGetEmptyArrayTest extends ArrayUtilsTest
{
    public function testIfValueIsArrayMustReturnValue(): void
    {
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray([]));
        $this->assertEquals([1, 2, 'g', null], ArrayUtils::getValueIfIsArrayElseGetEmptyArray([1, 2, 'g', null]));
    }

    public function testIfValueIsNotArrayMustReturnEmptyArray(): void
    {
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray(null));
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray(new \stdClass()));
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray(1));
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray(1.01));
        $this->assertEquals([], ArrayUtils::getValueIfIsArrayElseGetEmptyArray('assa'));
    }
}
