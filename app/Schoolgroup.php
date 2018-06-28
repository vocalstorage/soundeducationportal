<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schoolgroup extends Model
{
    protected $fillable = [
        'title',
    ];


    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function warnings()
    {
        $html = "";

        if ($this->students()) {
            $html .= '<p class="warning">Bevat ' . $this->students()->count() . ' student(en)</p>';
        }

        $openLessons = 0;
        foreach ($this->lessons as $lesson) {
            if (!$lesson->deadline->isPast()) {
                $openLessons++;
            }
        }

        if ($this->students()) {
            $html .= '<p class="warning">Heeft open ' . $openLessons . ' les(sen)</p>';
        }


        return $html;
    }
}
