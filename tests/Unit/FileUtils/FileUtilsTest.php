<?php


namespace Tests\Unit\FileUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\FileUtils;

class FileUtilsTest extends TestCase
{
    /* @var FileUtils $fileUtils */
    protected $fileUtils;

    protected function setUp(): void
    {
        $this->fileUtils = new FileUtils();
    }

    public function testReplaceSlashesByDirectorySeparator(): void
    {
        $ds = DIRECTORY_SEPARATOR;

        $this->assertEquals(
            "{$ds}var{$ds}www{$ds}html{$ds}..{$ds}www{$ds}",
            $this->fileUtils->replaceSlashesByDirectorySeparator('/var/www/html/../www/')
        );
        $this->assertEquals(
            "{$ds}var{$ds}www{$ds}html{$ds}..{$ds}www{$ds}",
            $this->fileUtils->replaceSlashesByDirectorySeparator('\var\www\html\..\www/')
        );
    }

    public function _testWriteFile(): void
    {
        $path = './tmp/t/t/y/u/i/o/ghgftt.txt';
        $data = 'Lalala';

        $this->fileUtils->writeFile($path, $data);
        $this->assertFileExists($path);
    }
}
