<?php


namespace Sokolovvs\Utils\ArrayUtils;


use Sokolovvs\Utils\StringUtils\StringUtils;

class ArrayUtils
{
    /**
     * Result = $array - $otherArray.
     *
     * @param array $array
     * @param array $otherArray
     *
     * @return array
     * @example [2, 3, 'b']  = subtract(['a', 'b', 2, 3, 4, 5], [4, 5, 'a'])
     */
    public static function subtract(array $array, array $otherArray): array
    {
        return array_values(array_diff($array, array_intersect($array, $otherArray)));
    }

    /**
     * Symmetric difference of sets. Result = $array - $otherArray.
     *
     * @param array $array
     * @param array $otherArray
     *
     * @return array
     * @example [3, 4, 5, 'b']  = symmetricDiff(['a', 'b', 2, 3], [4, 5, 'a'])
     */
    public static function symmetricDiff(array $array, array $otherArray): array
    {
        $mergeResult = array_merge(static::subtract($array, $otherArray), static::subtract($otherArray, $array));

        return array_values($mergeResult);
    }

    /**
     * If $value is array then return $value, else return empty array.
     *
     * @param $value
     *
     * @return array
     */
    public static function castToArray($value): array
    {
        return is_array($value) ? $value : [];
    }

    /**
     * Checking arrays equals.
     *
     * @param array $array
     * @param array $otherArray
     * @param bool  $checkSorting
     *
     * @return bool
     */
    public static function equals(array $array, array $otherArray, bool $checkSorting = true): bool
    {
        return $checkSorting
            ? $array === $otherArray
            : count($array) === count($otherArray)
            && array_diff($array, $otherArray) === array_diff($otherArray, $array);
    }

    /**
     * Generate random chars.
     *
     * @param int    $length
     * @param string $alphabet
     *
     * @return string[]
     */
    public static function rand(
        int $length = 15,
        $alphabet = '_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): array {
        return StringUtils::toArray(StringUtils::rand($length, $alphabet));
    }

    public static function isSubsetOf(iterable $subset, iterable $set, ?callable $comparator = null): bool
    {
        $setContainsAllItemsFromSet = true;
        $defaultComparator = static function ($item, $otherItem) {
            return $item === $otherItem;
        };
        $comparator = $comparator ?: $defaultComparator;

        foreach ($subset as $subsetItem) {
            $setContainsSubsetItem = false;

            foreach ($set as $setItem) {
                if ($comparator($setItem, $subsetItem)) {
                    $setContainsSubsetItem = true;
                    break;
                }
            }

            $setContainsAllItemsFromSet = $setContainsSubsetItem;

            if (!$setContainsAllItemsFromSet) {
                break;
            }
        }

        return $setContainsAllItemsFromSet;
    }
}
