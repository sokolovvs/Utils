<?php


namespace Sokolovvs\Utils\NumberUtils;


class NumberUtils
{
    /**
     * @param $number
     *
     * @return int|null
     */
    public static function castToPositiveInt($number): ?int
    {
        return static::isPositiveInt($number) ? static::filterInt($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isPositiveInt($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number > 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function castToNotNegativeInt($number): ?int
    {
        return static::isNotNegativeInt($number) ? static::filterInt($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotNegativeInt($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function castToNegativeInt($number): ?int
    {
        return static::isNegativeInt($number) ? static::filterInt($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNegativeInt($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number < 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public static function castToNotPositiveInt($number): ?int
    {
        return static::isNotPositiveInt($number) ? static::filterInt($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotPositiveInt($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number <= 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function castToPositiveNum($number)
    {
        return static::isPositiveNum($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isPositiveNum($number): bool
    {
        return is_numeric($number) && $number > 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function castToNotNegativeNum($number)
    {
        return static::isNotNegativeNum($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotNegativeNum($number): bool
    {
        return is_numeric($number) && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function castToNegativeNum($number)
    {
        return static::isNegativeNum($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNegativeNum($number): bool
    {
        return is_numeric($number) && $number < 0;
    }

    /**
     * @param $number
     *
     * @return null|double|float|int
     */
    public static function castToNotPositiveNum($number)
    {
        return static::isNotPositiveNum($number) ? static::filterNumeric($number) : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public static function isNotPositiveNum($number): bool
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
     * @param int $digitCount
     *
     * @return float|int|null
     */
    public static function toFixed($number, int $digitCount = 2)
    {
        if ($digitCount <= 0) {
            throw new \InvalidArgumentException('Parameter $digitCount must be positive integer');
        }

        if (!is_numeric($number)) {
            return null;
        }

        $expo = 10 ** $digitCount;

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
    public static function filterInt($number): ?int
    {
        $number = filter_var($number, FILTER_VALIDATE_INT);

        return $number ? $number : null;
    }
}
