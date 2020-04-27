<?php


namespace Tests\Unit\PhoneUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\PhoneUtils\PhoneUtils;

class PhoneUtilsValidateTest extends TestCase
{
    /**
     * @dataProvider dataProvideForDefault
     */
    public function testWithDefaultParameters($phone, $expected): void
    {
        $this->assertEquals($expected, PhoneUtils::validate($phone));
    }

    public function dataProvideForDefault(): array
    {
        return [
            '\'109120\' -> false' => ['109120', false],
            '\'109120109120\' -> true' => ['109120109120', true],
            '\'+109120109120\' -> true' => ['+109120109120', true],
            '\'+109120109120+\' -> true' => ['+109120109120+', false],
            ' \'+109120109120 \' -> false' => [' +109120109120 ', false],
            '\'++109120109120\' -> false' => ['++109120109120', false],
            '\'\' => false' => ['', false],
            '\'      109120109120      \' => false' => ['      109120109120      ', false],
            '\'109120109120109120109120\' -> false' => ['109120109120109120109120', false],
            '\'54545445s6F5\' -> false' => ['54545445s6F5', false],
            '\'+++++++++++++++++\' -> false' => ['+++++++++++++++++', false],
        ];
    }

    /**
     * @dataProvider dataProvide
     */
    public function test($phone, $min, $max, $expected): void
    {
        $this->assertEquals($expected, PhoneUtils::validate($phone, $min, $max));
    }

    public function dataProvide(): array
    {
        return [
            '(\'109120\', 6, 20) -> true' => ['109120', 6, 20, true],
            '(\'1091\', 5, 20) -> false' => ['1091', 5, 20, false],
            '(\'109110911091\', 5, 10) -> false' => ['1091', 5, 10, false],
            '(\'109110911091\', 5, 12) -> true' => ['109110911091', 5, 12, true],
        ];
    }
}
