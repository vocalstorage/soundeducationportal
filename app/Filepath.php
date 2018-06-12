<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filepath extends Model
{
    public  $fillable = [
        'path',
    ];

    public function studio()
    {
        return $this->hasOne(Studio::class);
    }

    public function lesson()
    {
        return $this->hasOne(Lesson::class);
    }
}
