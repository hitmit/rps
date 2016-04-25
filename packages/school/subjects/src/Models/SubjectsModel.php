<?php

namespace School\Subjects\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectsModel extends Model
{
    protected $table = 'subject';

    public $timestamps = false;

    protected $fillable = [
        'subjectTitle', 'teacherId', 'passGrade', 'finalGrade'
    ];
}
