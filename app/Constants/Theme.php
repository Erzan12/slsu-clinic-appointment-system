<?php

namespace App\Constants;

class Theme
{
    private static $theme = "dark";

    public static function getTheme()
    {
        return self::$theme;
    }

    public static function setTheme($theme = 'dark')
    {
        return self::$theme = $theme;
    }
}