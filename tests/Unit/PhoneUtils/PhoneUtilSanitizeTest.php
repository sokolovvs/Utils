<?php


namespace Tests\Unit\PhoneUtils;



use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\PhoneUtils\PhoneUtils;

class PhoneUtilSanitizeTest extends TestCase
{
    /**
     * @dataProvider dataProvide
     */
    public function test($phone, $expected): void
    {
        $this->assertEquals($expected, PhoneUtils::sanitize($phone));
    }

    public function dataProvide(): array
    {
        return [
            ' \' 3290   \' -> \'3290\'' => [' 3290   ', '3290'],
            ' \' 3290  8970  4 \' -> \'329089704\'' => [' 3290  8970  4 ', '329089704'],
            ' \' 3f3290df  8970@gf  4 \' -> \'329089704\'' => [' 3f3290df  8970@gf  4 ', '3329089704'],
            '\'\' -> \'\'' => ['', ''],
            '\n\t\vgffgkj-+@4 \n' => ['\n\t\vgffgkj-+@4 \n', '4'],
            '\'4389344030949439040\' -> \'4389344030949439040\'' => ['4389344030949439040', '4389344030949439040'],
            '\'+4389344030949439040\' -> \'+4389344030949439040\'' => ['+4389344030949439040', '+4389344030949439040'],
            '\' + 4389344030949439040\' -> \'+4389344030949439040\'' => [' + 4389344030949439040', '+4389344030949439040'],
            '4389344030949439040 -> \'\'' => [4389344030949439040, ''],
            'null -> \'\'' => [null, ''],
            ' \'+++++\'  -> \'+\'' => [' +++++ ', '+'],
        ];
    }
}
