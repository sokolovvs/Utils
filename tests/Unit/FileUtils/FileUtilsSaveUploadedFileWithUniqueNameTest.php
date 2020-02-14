<?php


namespace Tests\Unit\FileUtils;


use Sokolovvs\Utils\FileUtils\FileUtils;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUtilsSaveUploadedFileWithUniqueNameTest extends FileUtilsTest
{
    protected function setUp(): void
    {
        parent::setUp();

        FileUtils::writeFile(static::PATH_TO_NEW_FILES . '/test.php', 'aa');
    }

    protected function tearDown(): void
    {
        FileUtils::clearDirectory(static::PATH_TO_NEW_FILES, '*.php');
        FileUtils::clearDirectory(static::PATH_TO_MOVED_FILES, '*.php');
    }

    public function test(): void
    {
        $prefix = 'sp2_';
        $ext = 'php';

        $uploadedFile = new UploadedFile(
            static::PATH_TO_NEW_FILES . '/test.php', 'test.php', 'application/php',
            UPLOAD_ERR_OK, true
        );

        $path = FileUtils::saveUploadedFileWithUniqueName(
            $uploadedFile, static::PATH_TO_MOVED_FILES,
            $prefix
        );

        $revertedPath = explode(DIRECTORY_SEPARATOR, $path);
        $fileName = array_pop($revertedPath);

        $this->assertStringStartsWith($prefix, $fileName);
        $this->assertStringEndsWith($ext, $path);
        $this->assertFileNotExists(static::PATH_TO_NEW_FILES . '/test.php');
        $this->assertFileExists($path);
    }
}
