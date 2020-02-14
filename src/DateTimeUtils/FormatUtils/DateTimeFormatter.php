<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils;


use DateTimeInterface;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\Format;

class DateTimeFormatter
{
    public static function dateToFormat(?DateTimeInterface $dateTime, Format $format): ?string
    {
        return $dateTime ? $dateTime->format($format->getDateFormat()) : null;
    }

    public static function dateTimeToFormat(?DateTimeInterface $dateTime, Format $format): ?string
    {
        return $dateTime ? $dateTime->format($format->getDateTimeFormat()) : null;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function getAllFormats(): array
    {
        $allFormats = [];

        foreach (get_declared_classes() as $class) {
            if ($class instanceof self) {
                $allFormats[] = $class;
            }
        }

        return $allFormats;
    }
}
