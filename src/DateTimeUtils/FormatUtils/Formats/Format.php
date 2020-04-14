<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats;


abstract class Format
{
    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
}
