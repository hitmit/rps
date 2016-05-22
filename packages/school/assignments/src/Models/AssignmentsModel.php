<?php

namespace School\Assignments\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentsModel extends Model
{
    protected $table = 'assignments';

    public $timestamps = false;

    protected $fillable = [
        'classId', 'subjectId', 'teacherId', 'AssignTitle', 'AssignDescription', 'AssignFile', 'AssignDeadLine'
    ];
}
