<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats;


class UsaFormat extends Format
{
    public function getDateFormat(): string
    {
        return 'm-d-Y';
    }

    public function getDateTimeFormat(): string
    {
        return 'm-d-Y H:i:s';
    }
}
