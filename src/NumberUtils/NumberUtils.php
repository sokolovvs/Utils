<?php


namespace Sokolovvs\Utils\NumberUtils;


class NumberUtils
{
    /**
     * @param $number
     *
     * @return int|null
     */
    public static function getPositiveIntegerOrNull($number): ?int
    {
        return static::isPositiveInteger($number) ? static::filterInteger($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isPositiveInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number > 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function getNotNegativeIntegerOrNull($number): ?int
    {
        return static::isNotNegativeInteger($number) ? static::filterInteger($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotNegativeInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function getNegativeIntegerOrNull($number): ?int
    {
        return static::isNegativeInteger($number) ? static::filterInteger($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNegativeInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number < 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function getNotPositiveIntegerOrNull($number): ?int
    {
        return static::isNotPositiveInteger($number) ? static::filterInteger($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotPositiveInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number <= 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function getPositiveNumberOrNull($number)
    {
        return static::isPositiveNumber($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isPositiveNumber($number): bool
    {
        return is_numeric($number) && $number > 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function getNotNegativeNumberOrNull($number)
    {
        return static::isNotNegativeNumber($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotNegativeNumber($number): bool
    {
        return is_numeric($number) && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function getNegativeNumberOrNull($number)
    {
        return static::isNegativeNumber($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNegativeNumber($number): bool
    {
        return is_numeric($number) && $number < 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function getNotPositiveNumberOrNull($number)
    {
        return static::isNotPositiveNumber($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotPositiveNumber($number): bool
    {
        return is_numeric($number) && $number <= 0;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public static function isOdd(int $number): bool
    {
        return $number & 1;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public static function isEven(int $number): bool
    {
        return !static::isOdd($number);
    }

    /**
     * @param     $number
     * @param int $decimals
     *
     * @return float|int|null
     */
    public static function toFixed($number, $decimals = 3)
    {
        if (!is_numeric($number)) {
            return null;
        }

        $expo = 10 ** $decimals;

        return (int)($number * $expo) / $expo;
    }

    /**
     * @param $number
     *
     * @return int|float|double|null
     */
    public static function filterNumeric($number)
    {
        $numberFloat = filter_var($number, FILTER_VALIDATE_FLOAT);
        $numberInt = filter_var($number, FILTER_VALIDATE_INT);

        $number = $numberFloat;

        if ($numberFloat === false) {
            $number = $numberInt;
            if ($numberInt === false) {
                $number = null;
            }
        }

        return $number;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function filterInteger($number): ?int
    {
        $number = filter_var($number, FILTER_VALIDATE_INT);

        return $number ? $number : null;
    }


}
