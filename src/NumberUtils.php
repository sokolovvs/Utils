<?php


namespace Sokolovvs\Utils;


class NumberUtils
{
    public function getPositiveIntegerOrNull($number): ?int
    {
        return $this->isPositiveInteger($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isPositiveInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number > 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public function getNotNegativeIntegerOrNull($number): ?int
    {
        return $this->isNotNegativeInteger($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNotNegativeInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public function getNegativeIntegerOrNull($number): ?int
    {
        return $this->isNegativeInteger($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNegativeInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number < 0;
    }

    /**
     * @param $number
     *
     * @return int|null
     */
    public function getNotPositiveIntegerOrNull($number): ?int
    {
        return $this->isNotPositiveInteger($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNotPositiveInteger($number): bool
    {
        return filter_var($number, FILTER_VALIDATE_INT) !== false && $number <= 0;
    }

    /**
     * @param $number
     *
     * @return null
     */
    public function getPositiveNumberOrNull($number)
    {
        return $this->isPositiveNumber($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isPositiveNumber($number): bool
    {
        return is_numeric($number) && $number > 0;
    }

    /**
     * @param $number
     *
     * @return null
     */
    public function getNotNegativeNumberOrNull($number)
    {
        return $this->isNotNegativeNumber($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNotNegativeNumber($number): bool
    {
        return is_numeric($number) && $number >= 0;
    }

    /**
     * @param $number
     *
     * @return null
     */
    public function getNegativeNumberOrNull($number)
    {
        return $this->isNegativeNumber($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNegativeNumber($number): bool
    {
        return is_numeric($number) && $number < 0;
    }

    /**
     * @param $number
     *
     * @return null
     */
    public function getNotPositiveNumberOrNull($number)
    {
        return $this->isNotPositiveNumber($number) ? $number : null;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    public function isNotPositiveNumber($number): bool
    {
        return is_numeric($number) && $number <= 0;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public function isOdd(int $number): bool
    {
        return $number & 1;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public function isEven(int $number): bool
    {
        return !$this->isOdd($number);
    }

    //TODO: implement isValidNumberRange
}
