<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;

return [
    'up' => function(){
        DB::schema()->create('users', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // create the first user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => password_hash('secret', PASSWORD_DEFAULT)
        ]);
    },

    'down' => function(){
        DB::schema()->dropIfExists('users');
    }
];