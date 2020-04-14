<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalDateTimeFormat;

class InternationalDateTimeFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new InternationalDateTimeFormat();
    }

    public function test(): void
    {
        $this->assertSame('d-m-Y H:i:s', $this->instance->getFormat());
    }
}
