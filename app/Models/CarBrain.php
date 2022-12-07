<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrain extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'model_id',
        'uuid'

    ];

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
