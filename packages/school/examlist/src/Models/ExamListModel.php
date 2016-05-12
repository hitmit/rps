<?php

namespace School\ExamList\Models;

use Illuminate\Database\Eloquent\Model;

class ExamListModel extends Model
{
    protected $table = 'examslist';

    public $timestamps = false;

    protected $fillable = [
        'examTitle', 'examDescription', 'examDate', 'examAcYear'
    ];
}
