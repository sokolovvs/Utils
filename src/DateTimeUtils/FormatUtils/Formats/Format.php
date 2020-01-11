<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats;


abstract class Format
{
    abstract public function getDateFormat(): string;

    abstract public function getDateTimeFormat(): string;
}
