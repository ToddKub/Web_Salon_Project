<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use HasFactory, Sortable;
    use SoftDeletes;
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'service',
        'time',
        'date',
        'beautician_name',
        'user_id',
        'price',
        'payment_status',
        'payment_intent_id'
    ];
    public $sortable = [
        'booking_id',
        'service',
        'time',
        'date',
        'beautician_name',
        'user_id',
        'price',
        'payment_status'
    ];
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
