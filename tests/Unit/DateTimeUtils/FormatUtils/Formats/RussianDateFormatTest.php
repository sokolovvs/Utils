<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\RussianDateFormat;

class RussianDateFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new RussianDateFormat();
    }

    public function test(): void
    {
        $this->assertSame('d.m.Y', $this->instance->getFormat());
    }

}
