<?php

class FormatBytes
{

    private static $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

    public static function format($size, $precision = 2)
    {
        $base = log($size, 1024);

        return round(pow(1024, $base - floor($base)), $precision) .' '. self::$suffixes[floor($base)];
    }

}