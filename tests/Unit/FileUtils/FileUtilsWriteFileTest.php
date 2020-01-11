<?php


namespace Tests\Unit\FileUtils;


class FileUtilsWriteFileTest extends FileUtilsTest
{

    private const PATHS_TO_FILES = ['new_test_file.txt', './new_test_file_via_dot'];

    private const CONTENT_FOR_FILES = ['AAfdiddfkk3kпрпа', "плалалпал  4544554 \е\р\t\v\n", 'rfsf', ''];

    /**
     * @dataProvider dataProvideWriteFileInCurrentDirWithValidPath
     */
    public function testWriteEmptyFileInCurrentDirWithValidPath($path, $fileContent): void
    {
        if (is_file($path)) {
            unlink($path);
            $this->testWriteEmptyFileInCurrentDirWithValidPath($path, $fileContent);
        }

        $this->fileUtils->writeFile($path, $fileContent);

        $this->assertFileExists($path);
        $this->assertStringEqualsFile($path, $fileContent);
    }

    public function dataProvideWriteFileInCurrentDirWithValidPath(): array
    {
        return [
            'path without \'.\' in current dir' => [self::PATHS_TO_FILES[0], array_rand(self::CONTENT_FOR_FILES)],
            'path via \'.\' in current dir' => [self::PATHS_TO_FILES[1], array_rand(self::CONTENT_FOR_FILES)],
            'write to temp dir' => ["{$this->pathToTempDir}/test.test", array_rand(self::CONTENT_FOR_FILES)],
        ];
    }

    public function tearDown(): void
    {
        $allPaths = array_merge(self::PATHS_TO_FILES, ["{$this->pathToTempDir}/test.test"]);

        foreach ($allPaths as $path) {
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
