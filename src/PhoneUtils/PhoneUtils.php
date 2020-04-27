<?php


namespace Sokolovvs\Utils\PhoneUtils;


class PhoneUtils
{
    public static function validate(string $value, int $minCountRequired = 11, int $maxCountRequired = 16): bool
    {
        $sanitized = self::sanitize($value);
        $length = mb_strlen($sanitized);

        if ($length < $minCountRequired || $length > $maxCountRequired || $sanitized !== $value) {
            return false;
        }

        return true;
    }

    public static function sanitize($value): string
    {
        if (is_string($value)) {
            $value = trim($value);
            $firstChar = '';

            if (!empty($value)) {
                $firstChar = $value[0];
            }

            $value = preg_replace('/[^0-9]/', '', $value);

            if ($firstChar === '+') {
                $value = "+{$value}";
            }
        } else {
            $value = '';
        }

        return $value;
    }
}
