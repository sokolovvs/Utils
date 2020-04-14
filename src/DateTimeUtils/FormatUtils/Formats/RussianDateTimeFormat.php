<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats;


class RussianDateTimeFormat extends Format
{
    public function __construct()
    {
        parent::__construct('d.m.Y H:i:s');
    }
}
