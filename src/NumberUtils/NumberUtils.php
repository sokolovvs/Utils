<?php


namespace Sokolovvs\Utils\NumberUtils;


class NumberUtils
{
    /**
     * @param $number
     *
     * @return int|null
     */
    public function getPositiveIntegerOrNull($number): ?int
    {
        return $this->isPositiveInteger($number) ? $this->filterInteger($number) : null;
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
        return $this->isNotNegativeInteger($number) ? $this->filterInteger($number) : null;
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
        return $this->isNegativeInteger($number) ? $this->filterInteger($number) : null;
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
        return $this->isNotPositiveInteger($number) ? $this->filterInteger($number) : null;
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
     * @return null|double|float|int
     */
    public function getPositiveNumberOrNull($number)
    {
        return $this->isPositiveNumber($number) ? $this->filterNumeric($number) : null;
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
     * @return null|double|float|int
     */
    public function getNotNegativeNumberOrNull($number)
    {
        return $this->isNotNegativeNumber($number) ? $this->filterNumeric($number) : null;
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
     * @return null|double|float|int
     */
    public function getNegativeNumberOrNull($number)
    {
        return $this->isNegativeNumber($number) ? $this->filterNumeric($number) : null;
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
     * @return null|double|float|int
     */
    public function getNotPositiveNumberOrNull($number)
    {
        return $this->isNotPositiveNumber($number) ? $this->filterNumeric($number) : null;
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

    /**
     * @param     $number
     * @param int $decimals
     *
     * @return float|int|null
     */
    public function toFixed($number, $decimals = 3)
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
    public function filterNumeric($number)
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
    public function filterInteger($number): ?int
    {
        $number = filter_var($number, FILTER_VALIDATE_INT);

        return $number ? $number : null;
    }


}
