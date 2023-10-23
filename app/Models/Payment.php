<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'amount',
        'gateway_id',
        'token',
        'date',
        'trans_id',
        'id_get',
        'type',
        'status',
        'ip',
        'description'
    ];

}
