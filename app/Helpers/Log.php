<?php


namespace App\Helpers;

/**
 * Most basic log implementation
 * TODO: Modify code to actually handle log information
 * @package App\Helpers
 */
class Log
{
    /**
     * Log the given text
     * @param $text
     */
    public static function write($text)
    {
        echo $text . "\n";
    }
}