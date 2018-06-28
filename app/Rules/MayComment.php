<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\LessonDateRegistration;
use Illuminate\Support\Facades\Auth;

class MayComment implements Rule
{

    private $lessonDateRegistration;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lessonDateRegistration =  LessonDateRegistration::where('id',$this->id)
            ->where('student_id',Auth::user()->id)
            ->where('presence', false)->get();

        if(!$lessonDateRegistration->isEmpty()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Er is iets fout gegaan.';
    }
}
