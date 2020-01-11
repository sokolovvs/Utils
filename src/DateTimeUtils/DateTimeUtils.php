<?php


namespace Sokolovvs\Utils\DateTimeUtils;


use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Sokolovvs\Utils\DateTimeUtils\FormatUtils\DateTimeFormatter;

class DateTimeUtils
{

    /* @var DateTimeFormatter $dateTimeFormatter */
    private $dateTimeFormatter;

    public function __construct()
    {
        $this->dateTimeFormatter = new DateTimeFormatter();
    }

    /**
     * @codeCoverageIgnore
     * @return DateTimeFormatter
     */
    public function getDateTimeFormatter(): DateTimeFormatter
    {
        return $this->dateTimeFormatter;
    }

    /**
     * If $dateTimeAsString is invalid for creating DateTimeImmutable object then return null, else return DateTime
     * object.
     *
     * @param $dateTimeAsString
     *
     * @return DateTimeImmutable|null
     */
    public function getDateTimeImmutableOrNullFromString($dateTimeAsString): ?DateTimeImmutable
    {
        return $this->isValidDateTimeString($dateTimeAsString) ? new DateTimeImmutable($dateTimeAsString) : null;
    }

    /**
     * If $dateTimeAsString is invalid for creating DateTime object then return null, else return DateTime object.
     *
     * @param $dateTimeAsString
     *
     * @return DateTime|null
     */
    public function getDateTimeMutableOrNullFromString($dateTimeAsString): ?DateTime
    {
        return $this->isValidDateTimeString($dateTimeAsString) ? new DateTime($dateTimeAsString) : null;
    }

    /**
     * If $dateTimeAsString is invalid for creating DateTime object then return false, else return true.
     *
     * @param $dateTimeAsString
     *
     * @return bool
     */
    public function isValidDateTimeString($dateTimeAsString): bool
    {
        if (is_string($dateTimeAsString)) {
            $dateTimeAsString = trim($dateTimeAsString);
        }

        try {
            if ($dateTimeAsString === '' || !is_string($dateTimeAsString)) {
                throw new  \RuntimeException('');
            }
            $dateTime = new DateTimeImmutable($dateTimeAsString);
        } catch (\Exception $exception) {
            $dateTime = null;
        }

        return $dateTime instanceof DateTimeInterface;
    }

    /**
     * Return true if $timezone valid for creating DateTimeZone, else return false.
     *
     * @param string|null $timezone
     *
     * @return bool
     */
    public function timezoneExists(string $timezone): bool
    {
        try {
            $dateTimeZone = new DateTimeZone($timezone);
        } catch (\Exception $e) {
            $dateTimeZone = null;
        }

        return $dateTimeZone instanceof DateTimeZone;
    }

    /**
     * Return DateTimeZone if $timezone valid for creating DateTimeZone, else return null.
     *
     * @param string $timezone
     *
     * @return DateTimeZone|null
     */
    public function getTimezoneIfExists(string $timezone): ?DateTimeZone
    {
        try {
            $dateTimeZone = new DateTimeZone($timezone);
        } catch (\Exception $e) {
            $dateTimeZone = null;
        }

        return $dateTimeZone instanceof DateTimeZone ? $dateTimeZone : null;
    }
}
