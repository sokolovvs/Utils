<?php


namespace Tests\Unit\ArrayUtils;


class ArrayGetValueIfIsArrayElseGetEmptyArrayTest extends ArrayUtilsTest
{
    public function testIfValueIsArrayMustReturnValue(): void
    {
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray([]));
        $this->assertEquals([1, 2, 'g', null], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray([1, 2, 'g', null]));
    }

    public function testIfValueIsNotArrayMustReturnEmptyArray(): void
    {
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray(null));
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray(new \stdClass()));
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray(1));
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray(1.01));
        $this->assertEquals([], $this->arrayUtils->getValueIfIsArrayElseGetEmptyArray('assa'));
    }
}
