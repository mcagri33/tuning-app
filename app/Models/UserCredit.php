<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCredit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'amount',
        'price',
        'status',
        'currency_id',
        'type',
        'uuid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
