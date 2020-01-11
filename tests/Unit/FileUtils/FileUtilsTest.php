<?php


namespace Tests\Unit\FileUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\FileUtils\FileUtils;
use Sokolovvs\Utils\StringUtils\StringUtils;

abstract class FileUtilsTest extends TestCase
{
    public const PATH_TO_MOVED_FILES = './tests/Support/TestData/DirForMovedFiles';

    public const PATH_TO_NEW_FILES = 'tests/Support/TestData/DirForNewFiles';

    /* @var FileUtils $fileUtils */
    protected $fileUtils;

    /* @var StringUtils $stringUtils */
    protected $stringUtils;

    /* @var string $pathToTempDir */
    protected $pathToTempDir;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->pathToTempDir = sys_get_temp_dir();
        parent::__construct($name, $data, $dataName);
    }

    protected function setUp(): void
    {
        $this->fileUtils = new FileUtils();
        $this->stringUtils = new StringUtils();
    }
}
