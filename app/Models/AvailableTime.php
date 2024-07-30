<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableTime extends Model
{
    use HasFactory;
    protected $table = 'available_times';
    protected $fillable = [
        'time_slot',
    ];
}
