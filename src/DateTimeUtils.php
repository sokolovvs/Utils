<?php


namespace Sokolovvs\Utils;


use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

class DateTimeUtils
{
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

        return (bool)($dateTime instanceof DateTimeInterface);
    }

    /**
     * Get date as d.m.Y
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getRussianDateFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('d.m.Y');
    }

    /**
     * Get datetime as d.m.Y H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getRussianDateTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('d.m.Y H:i:s');
    }

    /**
     * Get time as H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getRussianTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('H:i:s');
    }

    /**
     * * Get date as d-m-Y
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getInternationalDateFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('d-m-Y');
    }

    /**
     * Get datetime as d-m-Y H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getInternationalDateTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('d-m-Y H:i:s');
    }

    /**
     * Get time as H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getInternationalTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('H:i:s');
    }

    /**
     * Get date as m-d-Y
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getUsaDateFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('m-d-Y');
    }

    /**
     * Get date as m-d-Y H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getUsaDateTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('m-d-Y H:i:s');
    }

    /**
     * Get date H:i:s
     *
     * @param DateTimeInterface $dateTime
     *
     * @return string
     */
    public function getUsaTimeFormat(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('H:i:s');
    }

    /**
     * Convert DateTimeImmutable from DateTime
     *
     * @param DateTime $dateTime
     *
     * @return DateTimeImmutable
     */
    public function convertDateTimeToDateTimeImmutable(DateTime $dateTime): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($dateTime);
    }

    /**
     * Convert DateTime from DateTimeImmutable
     *
     * @param DateTimeImmutable $dateTime
     *
     * @return DateTime
     */
    public function convertDateTimeImmutableToDateTimeMutable(DateTimeImmutable $dateTime): DateTime
    {
        return DateTime::createFromImmutable($dateTime);
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

        return (bool)($dateTimeZone instanceof DateTimeZone);
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

    //TODO: transformToDateTimeRange(), implement class Range, DateTimeRange
    //TODO: isValidDateTimeRange
}
