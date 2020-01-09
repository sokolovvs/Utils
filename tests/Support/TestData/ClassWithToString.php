<?php


namespace Tests\Support\TestData;


class ClassWithToString
{
    private $parameter;

    /**
     * ClassWithImplementedToStringMethod constructor.
     *
     * @param $parameter
     */
    public function __construct(string $parameter = "A")
    {
        $this->parameter = $parameter;
    }

    public function __toString()
    {
        return $this->parameter;
    }


}
