<?php


namespace Sokolovvs\Utils\BooleanAdapter;


class BooleanAdapter
{
    public static function toBoolean($value): bool
    {
        if (is_array($value)) {
            return empty($value) ? false : true;
        }

        if (is_object($value)) {
            return true;
        }

        if (is_numeric($value)) {
            if (is_string($value)) {
                $value = trim($value);
            }

            return $value != 0;
        }

        $filterResult = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($filterResult === null && is_string($value)) {
            $jsonObj = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                if ($jsonObj === [0]) { // [0] = json_decode("{}", true)
                    return true;
                }

                return is_bool($jsonObj) ? $jsonObj : (bool)$jsonObj;
            }


            return empty($value) ? false : true;
        }

        return $filterResult === true;
    }

    public static function toBooleanOrNull($value)
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            $value = trim($value);

            if ($value === 'null') {
                return null;
            }
        }

        return static::toBoolean($value);
    }
}
