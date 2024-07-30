<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refunduser extends Model
{
    use HasFactory;
    protected $table = 'refunds';
    protected $fillable = [
    'booking_id', 
    'reason',
    'addition_info', 
    'status',
    'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
