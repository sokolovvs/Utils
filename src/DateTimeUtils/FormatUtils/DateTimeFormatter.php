<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils;


use DateTimeInterface;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\Format;

class DateTimeFormatter
{
    public static function format(?DateTimeInterface $dateTime, Format $format): ?string
    {
        return $dateTime ? $dateTime->format($format->getFormat()) : null;
    }
}
