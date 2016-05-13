<?php

namespace School\Classes\Models;

use Illuminate\Database\Eloquent\Model;

class ClassScheduleModel extends Model
{
    protected $table = 'classschedule';

    public $timestamps = false;

    protected $fillable = [
        'classId', 'subjectId', 'dayOfWeek', 'startTime', 'endTime'
    ];
}
