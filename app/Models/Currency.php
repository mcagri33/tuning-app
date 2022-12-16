<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'code',
        'symbol',
        'value',
        'status',
        'language_id'
    ];

    public function credit()
    {
        return $this->hasMany(UserCredit::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
