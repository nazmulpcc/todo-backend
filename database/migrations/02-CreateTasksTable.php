<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;
use App\Models\Todo;

return [
    'up' => function(){
        DB::schema()->create('tasks', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('body');
            $table->boolean('complete')->default(false);
            $table->timestamps();
        });
    },

    'down' => function(){
        DB::schema()->dropIfExists('tasks');
    }
];