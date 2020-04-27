<?php


namespace Sokolovvs\Utils\EmailUtils;


class EmailUtils
{
    public static function validate(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function sanitize($value): string
    {
        if (is_string($value)) {
            $sanitized = filter_var($value, FILTER_SANITIZE_EMAIL);
        } else {
            $sanitized = '';
        }

        return $sanitized;
    }
}
