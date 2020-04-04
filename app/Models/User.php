<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = [];

    protected $hidden = ['password', 'created_at', 'updated_at'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}