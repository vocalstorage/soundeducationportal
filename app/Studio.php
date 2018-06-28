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
        'number',
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

    public function warnings(){
        $html = "";
        if($this->teacher()){
            $html .= '<p class="warning">Deze studio heeft een relatie met '. $this->teacher->name.'</p>';
        }
        if($this->teacher->lesson_dates()){
            $html .= '<p class="warning">Deze studio heeft een leraar die nog  '. $this->teacher->lesson_dates()->count().' lessen open heeft staan</p>';
        }

        return $html;
    }
}
