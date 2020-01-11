<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalFormat;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\RussianFormat;

class RussianFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new RussianFormat();
    }

    public function testGetDateFormat(): void
    {
        $this->assertSame('d.m.Y', $this->instance->getDateFormat());
    }

    public function testGetDateTimeFormat(): void
    {
        $this->assertSame('d.m.Y H:i:s', $this->instance->getDateTimeFormat());
    }
}
