<?php


namespace Tests\Unit\EmailUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\EmailUtils\EmailUtils;

class EmailUtilsValidateTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($email, $expected): void
    {
        $this->assertEquals($expected, EmailUtils::validate($email));
    }

    public function dataProvide(): array
    {
        return [
            ' \'a@a.a\' -> true' => ['a@a.a', true],
            ' \'   a@a.a\ \t\n\v\' -> false' => ["   a@a.a\ \t\n\v", false],
            ' \'   asdfzxcasdfzxc.fd\' -> false' => ['   asdfzxcasdfzxc.\ fd', false],
            ' \'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc\' -> false' => [
                'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc',
                false,
            ],
            ' \'\' -> false' => ['', false],
        ];
    }
}
