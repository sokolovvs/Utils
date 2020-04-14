<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaDateTimeFormat;

class UsaDateTimeFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new UsaDateTimeFormat();
    }

    public function test(): void
    {
        $this->assertSame('m-d-Y H:i:s', $this->instance->getFormat());
    }
}
