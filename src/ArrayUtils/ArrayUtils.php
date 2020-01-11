<?php


namespace Sokolovvs\Utils\ArrayUtils;


use Sokolovvs\Utils\StringUtils\StringUtils;

class ArrayUtils
{
    /* @var StringUtils $stringUtils */
    private $stringUtils;

    public function __construct()
    {
        $this->stringUtils = new StringUtils();
    }

    /**
     * Result = $array - $otherArray.
     *
     * @param array $array
     * @param array $otherArray
     *
     * @return array
     * @example [2, 3, 'b']  = subtract(['a', 'b', 2, 3, 4, 5], [4, 5, 'a'])
     */
    public function subtract(array $array, array $otherArray): array
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
    public function symmetricDiff(array $array, array $otherArray): array
    {
        $mergeResult = array_merge($this->subtract($array, $otherArray), $this->subtract($otherArray, $array));

        return array_values($mergeResult);
    }

    /**
     * If $value is array then return $value, else return empty array.
     *
     * @param $value
     *
     * @return array
     */
    public function getValueIfIsArrayElseGetEmptyArray($value): array
    {
        return is_array($value) ? $value : [];
    }

    /**
     * Checking arrays equals. TODO: add checking without sorting
     *
     * @param array $array
     * @param array $otherArray
     *
     * @return bool
     */
    public function equals(array $array, array $otherArray): bool
    {
        return $array === $otherArray;
    }

    /**
     * Generate random chars.
     *
     * @param int    $length
     * @param string $alphabet
     *
     * @return string[]
     */
    public function rand(
        int $length = 15,
        $alphabet = '_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): array {
        return $this->stringUtils->toArray($this->stringUtils->rand($length, $alphabet));
    }

}
