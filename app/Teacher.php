<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name',
        'color',
        'studio_id',];


    public function studio()
    {
        return $this->hasOne(studio::class);
    }

    public function lesson_dates(){
        return $this->hasMany(LessonDate::class);
    }
}
