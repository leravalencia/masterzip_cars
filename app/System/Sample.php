<?php

namespace App\System;


class Sample
{
    protected static $path = 'sample-report.json';
    protected static $folder = 'samples';
    /**
     * @return string
     */
    public static function getPath(): string
    {
        return self::$path;
    }

    /**
     * @return string
     */
    public static function getFolder(): string
    {
        return self::$folder;
    }
}
