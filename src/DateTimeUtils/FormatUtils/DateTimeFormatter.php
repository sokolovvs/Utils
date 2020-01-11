<?php


namespace Sokolovvs\Utils\DateTimeUtils\FormatUtils;


use DateTimeInterface;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\Formats\Format;

class DateTimeFormatter
{
    public function dateToFormat(DateTimeInterface $dateTime, Format $format): string
    {
        return $dateTime->format($format->getDateFormat());
    }

    public function dateTimeToFormat(DateTimeInterface $dateTime, Format $format): string
    {
        return $dateTime->format($format->getDateTimeFormat());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAllFormats(): array
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
