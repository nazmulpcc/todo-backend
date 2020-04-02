<?php

namespace App\Helpers;

class Config {

    /**
     * @var array
     */
    protected static $values = [];

    /**
     * Load config values from
     */
    public static function load()
    {
        $files = glob(BASEDIR . '/config/*.php');
        foreach ($files as $file){
            $key = str_replace('.php', '', basename($file));
            static::$values[$key] = include $file;
        }
    }

    /**
     * Get a config value
     * @param string $file Base file name
     * @param string|false $key Array key name
     * @param mixed|null $default
     * @return mixed|null
     */
    public static function get($file, $key = false, $default = null)
    {
        if(isset(static::$values[$file])){
            if(! $key){
                return static::$values[$file];
            }
            if(isset(static::$values[$file][$key])){
                return static::$values[$file][$key];
            }
        }
        return $default;
    }
}