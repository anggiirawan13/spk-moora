<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeValue extends Model
{
    use HasFactory;

    protected $table = 'alternative_values';

    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'sub_criteria_id',
    ];

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function subCriteria()
    {
        return $this->belongsTo(SubCriteria::class, 'sub_criteria_id');
    }
}
