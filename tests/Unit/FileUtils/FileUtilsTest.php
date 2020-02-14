<?php


namespace Tests\Unit\FileUtils;


use PHPUnit\Framework\TestCase;

abstract class FileUtilsTest extends TestCase
{
    protected const PATH_TO_MOVED_FILES = './tests/Support/TestData/DirForMovedFiles';

    protected const PATH_TO_NEW_FILES = 'tests/Support/TestData/DirForNewFiles';

    /* @var string $pathToTempDir */
    protected $pathToTempDir;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->pathToTempDir = sys_get_temp_dir();
        parent::__construct($name, $data, $dataName);
    }
}
