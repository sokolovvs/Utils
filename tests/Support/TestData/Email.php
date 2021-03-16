<?php


namespace Tests\Support\TestData;


class Email
{
    /**
     * @var string
     */
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getValue()
    {
        return $this->email;
    }
}
