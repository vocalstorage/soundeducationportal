<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    public  $fillable = [
        'title',
        'description',
        'deadline',
        'max_registration',
        'teacher_id',
        'filepath_id',
    ];

    public function lessonDates(){
       return $this->hasMany(LessonDate::class)->orderBy('date', 'ASC')->orderBy('time', 'ASC');
    }

    public function filepath()
    {
        return $this->belongsTo(Filepath::class);
    }

    public function diffDeadline(){
        $diffInDays = Carbon::parse($this->deadline)->diffInDays(Carbon::now());
        return $diffInDays;
    }

    public function removeLessonDates(){
        $i = 0;
        if($this->lessonDates->count() > 0){
            foreach ($this->lessonDates as $lessonDate){
                $date = Carbon::parse($lessonDate->date);
                if($date->isPast()){
                    $lessonDate->lessonDateRegistrations()->delete();
                    $lessonDate->delete();
                    $i++;
                }
            }
        }
        return $i;
    }
}
