<?php

use App\Helpers\Config;

/**
 * Get config value
 * Laravel styled dotted key, but only one nested key allowed
 * @param string $key
 * @param mixed|null $default
 * @return mixed|null
 */
function config($key, $default = null){
    $frags = explode('.', $key, 2);
    return Config::get($frags[0], $frags[1] ?? false, $default);
}