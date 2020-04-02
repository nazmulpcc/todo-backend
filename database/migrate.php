#!/usr/bin/env php
<?php

require_once __DIR__ . '/../bootstrap.php';

$path = BASEDIR . '/database/migrations';

$files = glob("$path/*.php");

foreach ($files as $file){
    $actions = include $file;
    echo "Dropping ". basename($file) . "\n";
    call_user_func($actions['down']);
}

foreach ($files as $file){
    $actions = include $file;
    echo "Migrating ". basename($file) . "\n";
    call_user_func($actions['up']);
}

echo "Done.\n";