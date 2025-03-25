<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;
    protected $fillable = ['nama','C1','C2','C3','C4','C5','kriteria_id'];

    public function criteria(){
        return $this->belongsTo(Criteria::class, 'kriteria_id', 'id');
    }
}
