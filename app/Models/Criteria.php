<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criterias';

    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'atribut',
    ];

    public function alternativeValues()
    {
        return $this->hasMany(AlternativeValue::class, 'criteria_id');
    }
}
