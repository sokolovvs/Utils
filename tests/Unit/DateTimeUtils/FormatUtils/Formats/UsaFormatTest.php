<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaFormat;

class UsaFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new UsaFormat();
    }

    public function testGetDateFormat(): void
    {
        $this->assertSame('m-d-Y', $this->instance->getDateFormat());
    }

    public function testGetDateTimeFormat(): void
    {
        $this->assertSame('m-d-Y H:i:s', $this->instance->getDateTimeFormat());
    }
}
