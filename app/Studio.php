<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name',
        'description',
        'place',
        'street',
        'teacher_id',
        'postal_code'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
