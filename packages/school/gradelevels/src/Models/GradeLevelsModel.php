<?php

namespace School\GradeLevels\Models;

use Illuminate\Database\Eloquent\Model;

class GradeLevelsModel extends Model
{
    protected $table = 'gradelevels';

    public $timestamps = false;

    protected $fillable = [
        'gradeName', 'gradeDescription', 'gradePoints', 'gradeFrom', 'gradeTo'
    ];
}
