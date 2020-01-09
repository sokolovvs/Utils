<?php


namespace Sokolovvs\Utils;


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
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $currentPath));
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
    public function clearDirectory(string $path, string $pattern = '*'): void
    {
        $files = glob("$path/$pattern");

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }

            if (is_dir($file)) {
                rmdir($file); //TODO: need rmDirRecursive
            }
        }
    }

    public function saveUploadedFileWithUniqueName(
        UploadedFile $uploadedFile,
        string $pathToDir,
        string $prefixName = ''
    ): string {
        $unique = uniqid($prefixName);
        $fileExt = $uploadedFile->guessClientExtension();
        $path = "$unique.$fileExt";
        $path = $this->replaceSlashesByDirectorySeparator($path);
        $file = $uploadedFile->move($pathToDir, $path);

        return $file->getFilename();
    }

    // TODO: implement rmDirRecursive
}
