<?php

namespace School\Classes\Models;

use Illuminate\Database\Eloquent\Model;

class SectionModel extends Model{
    protected $table = 'sections';

    public $timestamps = false;

    protected $fillable = [
        'sectionName', 'sectionTitle', 'classId', 'teacherId'
    ];
} 