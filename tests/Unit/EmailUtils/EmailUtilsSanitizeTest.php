<?php


namespace Tests\Unit\EmailUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\EmailUtils\EmailUtils;

class EmailUtilsSanitizeTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($email, $expected): void
    {
        $this->assertEquals($expected, EmailUtils::sanitize($email));
    }

    public function dataProvide(): array
    {
        return [
            ' \'a@a.a\' -> \'a@a.a\'' => ['a@a.a', 'a@a.a'],
            ' \'   a@a.a\ \t\n\v\' -> \'a@a.a\'' => ["   a@a.a\ \t\n\v", 'a@a.a'],
            ' \'   asdfzxcasdfzxc.fd\' -> \'asdfzxcasdfzxc.fd\'' => ['   asdfzxcasdfzxc.\ fd', 'asdfzxcasdfzxc.fd'],
            ' \'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc\' -> \'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc\'' => [
                'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc',
                'asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxccasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxasdfzxcasdfzxcasdfzxcasdfzxcc@asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc.asdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxcasdfzxc',
            ],
            ' \'\' -> \'\'' => ['', ''],
            ' null -> \'\'' => [null, ''],
        ];
    }
}
