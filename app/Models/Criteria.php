<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    protected $fillable = ['kode','nama','bobot','atribut'];

    public function alternative(){
        return $this->hasMany(Alternative::class, 'kriteria_id', 'id');
    }
}
