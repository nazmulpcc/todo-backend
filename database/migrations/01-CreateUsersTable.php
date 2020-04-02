<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

return [
    'up' => function(){
        DB::schema()->create('users', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    },

    'down' => function(){
        DB::schema()->dropIfExists('users');
    }
];