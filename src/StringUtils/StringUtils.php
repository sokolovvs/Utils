<?php

namespace Sokolovvs\Utils\StringUtils;


class StringUtils
{
    /**
     * Name of magic method __toString.
     *
     * @var string
     */
    private const TO_STRING_METHOD_NAME = '__toString';

    /**
     * String type.
     *
     * @var string
     */
    private const STRING_TYPE = 'string';

    public const ENCODING = 'UTF-8';

    public static function hasStringForm($var): bool
    {
        return (!is_array($var))
            && ((!is_object($var) && settype($var, static::STRING_TYPE) !== false)
                || (is_object($var) && method_exists($var, static::TO_STRING_METHOD_NAME)));
    }

    /**
     * @param string|object|number $var
     *
     * @return string|null
     */
    public static function trimToNull($var): ?string
    {
        $str = static::trimToEmpty($var);

        return $str === '' ? null : $str;
    }

    /**
     * @param string|object|number $var
     *
     * @return string
     */
    public static function trimToEmpty($var): string
    {
        if (static::hasStringForm($var)) {
            $var = (string)$var;
        }

        if (is_string($var)) {
            $var = trim($var);
        } else {
            $var = null;
        }

        return trim($var);
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string          $haystack
     * @param string|string[] $needles
     *
     * @return bool
     */
    public static function startsWith(string $haystack, $needles): bool
    {
        if (is_array($needles)) {
            foreach ($needles as $needle) {
                if (is_string($needle) && $needle !== '' && mb_strpos($haystack, $needle) === 0) {
                    return true;
                }
            }
        } elseif (is_string($needles)) {
            if ($needles !== '' && mb_strpos($haystack, $needles) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Ends the $haystack string with the suffix $needle?
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function endsWith(string $haystack, $needles): bool
    {
        if (is_array($needles)) {
            foreach ($needles as $needle) {
                if (is_string($needle) && $needle !== '') {
                    $length = mb_strlen($needle);

                    if ((mb_substr($haystack, -$length) === $needle)) {
                        return true;
                    }
                }
            }
        } elseif (is_string($needles)) {
            $length = mb_strlen($needles);

            if (($needles !== '') && (mb_substr($haystack, -$length) === $needles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Does $haystack contain $needle?
     *
     * @param string          $haystack
     * @param string[]|string $needles
     *
     * @return bool
     */
    public static function contains(string $haystack, $needles): bool
    {
        if (is_array($needles)) {
            foreach ($needles as $needle) {
                if (is_string($needle) && $needle !== '' && mb_strpos($haystack, $needle) !== false) {
                    return true;
                }
            }
        } elseif (is_string($needles)) {
            if ($needles !== '' && mb_strpos($haystack, $needles) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Does $haystack contain $needle?
     *
     * @param string   $haystack
     * @param string[] $needles
     *
     * @return bool
     */
    public static function containsAll(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (is_string($needle) && $needle !== '') {
                if (mb_strpos($haystack, $needle) === false) {
                    return false;
                }
            } else {
                throw new \InvalidArgumentException('Array needles must contains only strings');
            }
        }

        return true;
    }

    public static function toArray(string $str): array
    {
        return preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
    }

    public static function stripSpace(string $string): string
    {
        return preg_replace('/\s+/', '', $string);
    }

    public static function toLowerCase(string $str): string
    {
        return mb_convert_case($str, MB_CASE_LOWER, self::ENCODING);
    }

    public static function toLowerCaseFirst(string $str): string
    {
        $fc = mb_strtolower(mb_substr($str, 0, 1));

        return $fc . mb_substr($str, 1);
    }

    public static function toUpperCase(string $str): string
    {
        return mb_convert_case($str, MB_CASE_UPPER, self::ENCODING);
    }

    public static function toUpperCaseFirst(string $str): string
    {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));

        return $fc . mb_substr($str, 1);
    }

    public static function toTitleCase(string $str): string
    {
        return mb_convert_case($str, MB_CASE_TITLE, self::ENCODING);
    }

    /**
     * Сan be used to generate a random string from UTF-8
     *
     * @param int                   $length
     * @param string|string[]|array $alphabet
     *
     * @return string
     */
    public static function rand(
        int $length = 15,
        $alphabet = '_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if (is_string($alphabet)) {
            $chars = static::toArray($alphabet);
        } elseif (is_array($alphabet)) {
            $chars = static::toArray(implode('', $alphabet));
        } else {
            throw new \InvalidArgumentException('Parameter alphabet must been string or array');
        }

        $result = '';

        while (mb_strlen($result) < $length) {
            $randIndex = random_int(0, count($chars) - 1);
            $result .= $chars[$randIndex];
        }

        return $result;
    }
}
