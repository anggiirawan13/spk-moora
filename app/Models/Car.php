<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function carType()
    {
        return $this->belongsTo(CarType::class, 'tipe_mobil');
    }

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class, 'merek');
    }
}
