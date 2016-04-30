<?php

namespace School\Classes\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';

    public $timestamps = false;

    protected $fillable = [
        'className', 'classTeacher', 'classAcademicYear', 'classSubjects', 'dormitoryId'
    ];
}
