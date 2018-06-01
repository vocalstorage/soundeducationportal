<?php

namespace App;

use Faker\Provider\File;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name',
        'description',
        'place',
        'street',
        'teacher_id',
        'postal_code',
        'filepath_id',
        ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function filepath()
    {
        return $this->belongsTo(Filepath::class);
    }
}
