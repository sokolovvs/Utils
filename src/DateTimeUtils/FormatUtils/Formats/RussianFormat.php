<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats;


class RussianFormat extends Format
{
    public function getDateFormat(): string
    {
        return 'd.m.Y';
    }

    public function getDateTimeFormat(): string
    {
        return 'd.m.Y H:i:s';
    }
}
