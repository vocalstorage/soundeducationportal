<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filepath extends Model
{
    public  $fillable = [
        'path',
    ];

    public function Studio()
    {
        return $this->hasOne(Studio::class);
    }

    public function Lesson()
    {
        return $this->hasOne(Lesson::class);
    }
}
