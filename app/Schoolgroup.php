<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolgroup extends Model
{
    protected $fillable = [
        'title',
    ];

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
}
