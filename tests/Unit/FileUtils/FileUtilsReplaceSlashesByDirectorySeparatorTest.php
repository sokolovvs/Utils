<?php


namespace Tests\Unit\FileUtils;


class FileUtilsReplaceSlashesByDirectorySeparatorTest extends FileUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($path, $expected): void
    {
        $this->assertSame($expected, $this->fileUtils->replaceSlashesByDirectorySeparator($path));
    }

    public function dataProvide(): array
    {
        $ds = DIRECTORY_SEPARATOR;

        return [
            'unix path' => ['/var/www/html/../www/', "{$ds}var{$ds}www{$ds}html{$ds}..{$ds}www{$ds}"],
            'windows path' => ['\\var\\www\\html\\..\\www\\', "{$ds}var{$ds}www{$ds}html{$ds}..{$ds}www{$ds}"],
            'mix path' => ['/var/www/html\\../www', "{$ds}var{$ds}www{$ds}html{$ds}..{$ds}www"],
            'string without slashes' => ['true', 'true'],
            'empty string' => ['', ''],
        ];
    }
}
