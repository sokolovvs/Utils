<?php


namespace Tests\Unit\FileUtils;


use Sokolovvs\Utils\FileUtils\FileUtils;

class FileUtilsRemoveDirRecursivelyTest extends FileUtilsTest
{
    /**
     * @dataProvider dataProvide
     */
    public function test($path, $fileContent, $dirForRemoving): void
    {
        if (!is_dir($dirForRemoving)) {
            FileUtils::writeFile($path, $fileContent);
            $this->test($path, $fileContent, $dirForRemoving);
        }

        FileUtils::removeDirRecursively($dirForRemoving);

        $this->assertDirectoryNotExists($dirForRemoving);
    }

    public function dataProvide(): array
    {
        return [
            'link to dir via dot' => ['./a/bb/ccc/ddd/f.txt', '', './a'],
            'link to dir without dot' => ['./a/bb/ccc/ddd/f.txt', '', 'a'],
            'fullpath' => ["{$this->pathToTempDir}/aa/bb/cc/test.test", '', "{$this->pathToTempDir}/aa",],
        ];
    }
}
