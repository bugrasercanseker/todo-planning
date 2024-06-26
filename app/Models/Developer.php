<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'level',
        'working_hours',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
