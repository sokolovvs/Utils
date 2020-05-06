<?php


namespace Tests\Unit\FileUtils;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\FileUtils\FileUtils;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class FileUtilsUploadFromResourceTest extends TestCase
{
    public function testSuccessCase() {
        $uf = FileUtils::uploadFromResource('https://upload.wikimedia.org/wikipedia/commons/a/a5/Google_Chrome_icon_%28September_2014%29.svg');
        $this->assertEquals('image/svg', $uf->getMimeType());
    }

    public function testFailCase() {
        $this->expectException(UploadException::class);
        $this->expectExceptionMessage('Could not find / upload file');
        $uf = FileUtils::uploadFromResource('https://up123.wikimedia.org/wikipedia/commons/a/a5/Google_Chrome_icon_%28September_2014%29.svg');
    }
}
