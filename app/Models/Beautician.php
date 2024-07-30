<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beautician extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'beauticians';
    protected $primaryKey ='id';
    protected $fillable = [
        'name',
    ];
}
