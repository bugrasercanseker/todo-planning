<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'level',
        'estimated_duration',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
