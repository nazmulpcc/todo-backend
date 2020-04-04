<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $hidden = ['updated_at'];

    protected $appends = ['created'];

    protected $casts = [
        'complete' => 'bool'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}