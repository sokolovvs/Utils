<?php


namespace Sokolovvs\Utils\FileUtils;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use Sokolovvs\Utils\StringUtils\StringUtils;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUtils
{
    /* @var StringUtils $stringUtils */
    protected $stringUtils;

    public function __construct()
    {
        $this->stringUtils = new StringUtils();
    }

    /**
     * Replace all '/' and '\' by DIRECTORY_SEPARATOR
     *
     * @param string $path
     *
     * @return string
     */
    public function replaceSlashesByDirectorySeparator(string $path): string
    {
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    /**
     * Write $data to file $path. Used native function file_put_contents (supported all flags). If directory is not
     * exist then directory will be created.
     *
     * @param string $path
     * @param string $data
     * @param int    $flag
     */
    public function writeFile(string $path, string $data, int $flag = 0): void
    {
        $path = trim($path);
        $path = $this->replaceSlashesByDirectorySeparator($path);
        $pathAsArray = explode(DIRECTORY_SEPARATOR, $path);

        if (!$this->stringUtils->startsWith($path, '/')) {
            $pathAsArray[0] = "./$pathAsArray[0]";
        }

        $fileName = array_pop($pathAsArray);
        $pathAsArray = implode(DIRECTORY_SEPARATOR, $pathAsArray);

        if ($pathAsArray) {
            $this->makeDirectory($pathAsArray);
        }

        file_put_contents($path, $data, $flag);
    }

    /**
     * Create directory recursively.
     *
     * @param string $path
     */
    public function makeDirectory(string $path): void
    {
        $explodedPath = explode('/', $path);
        $currentPath = $explodedPath[0];
        array_walk(
            $explodedPath, function ($dir) use (&$currentPath) {
            if ($currentPath !== '/') {
                $currentPath .= '/' . $dir;
            } else {
                $currentPath .= $dir;
            }

            if (!file_exists($currentPath) && !mkdir($currentPath) && !is_dir($currentPath)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $currentPath));
            }
        }
        );
    }

    /**
     * Remove files and directories by path and pattern. Used glob().
     *
     * @param string $path
     * @param string $pattern
     */
    public function clearDirectory($path = '*', $pattern = '*'): void
    {
        $files = glob("$path/$pattern");

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }

            if (is_dir($file)) {
                $this->clearDirectory($file);
            }
        }
    }

    /**
     * Recursively delete a directory and all of it's contents - e.g.the equivalent of `rm -r` on the command-line.
     * Consistent with `rmdir()` and `unlink()`, an E_WARNING level error will be generated on failure.
     *
     * @param string $source             absolute path to directory or file to delete.
     * @param bool   $removeOnlyChildren set to true will only remove content inside directory.
     *
     * @return bool true on success; false on failure
     */
    public function removeDirRecursively($source, $removeOnlyChildren = false): bool
    {
        if (empty($source) || file_exists($source) === false) {
            return false;
        }

        if (is_file($source) || is_link($source)) {
            return unlink($source);
        }

        $files = new RecursiveIteratorIterator
        (
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileInfo) {
            if ($fileInfo->isDir()) {
                if ($this->removeDirRecursively($fileInfo->getRealPath()) === false) {
                    return false;
                }
            } elseif (unlink($fileInfo->getRealPath()) === false) {
                return false;
            }
        }

        if ($removeOnlyChildren === false) {
            return rmdir($source);
        }

        return true;
    }

    public function saveUploadedFileWithUniqueName(
        UploadedFile $uploadedFile,
        string $pathToDir,
        string $prefixName = ''
    ): string {
        $unique = uniqid($prefixName);
        $fileExt = $uploadedFile->getClientOriginalExtension();
        $uniqueFileName = "$unique.$fileExt";
        $uniqueFileName = $this->replaceSlashesByDirectorySeparator($uniqueFileName);

        if (!is_dir($pathToDir)) {
            $this->makeDirectory($pathToDir);
        }

        $file = $uploadedFile->move($pathToDir, $uniqueFileName);

        return "$pathToDir/$uniqueFileName";
    }
}
