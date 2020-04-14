<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalDateFormat;

class InternationalDateFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new InternationalDateFormat();
    }

    public function test(): void
    {
        $this->assertSame('d-m-Y', $this->instance->getFormat());
    }
}
