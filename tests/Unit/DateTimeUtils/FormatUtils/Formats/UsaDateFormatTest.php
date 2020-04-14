<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\UsaDateFormat;

class UsaDateFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new UsaDateFormat();
    }

    public function test(): void
    {
        $this->assertSame('m-d-Y', $this->instance->getFormat());
    }
}
