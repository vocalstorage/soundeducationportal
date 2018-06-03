<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LessonDateRegistration extends Model
{
    protected $fillable = [
        'lesson_date_id',
        'student_id',
        'skill'];

    public function lessonDate()
    {
        return $this->belongsTo(LessonDate::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function mayCancel(){
        $date = Carbon::parse($this->lessonDate->date);
        $now = Carbon::now();
        if($date->diffInDays($now) > 5){
            return true;
        }
        return false;
    }
}
