<?php

namespace App\Helpers;

class Single
{
    public static array $data = [];

    public static function get($key)
    {
        if (empty(self::$data)) {
            self::$data = \App\Models\Single::pluck('value', 'key')->toArray();
        }

        return self::$data[$key] ?? null;

    }
}
