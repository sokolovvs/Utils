<?php


namespace Tests\Unit\DateTimeUtils\FormatUtils\Formats;


use PHPUnit\Framework\TestCase;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\InternationalFormat;

class InternationalFormatTest extends TestCase
{
    private $instance;

    protected function setUp(): void
    {
        $this->instance = new InternationalFormat();
    }

    public function testGetDateFormat(): void
    {
        $this->assertSame('d-m-Y', $this->instance->getDateFormat());
    }

    public function testGetDateTimeFormat(): void
    {
        $this->assertSame('d-m-Y H:i:s', $this->instance->getDateTimeFormat());
    }
}
