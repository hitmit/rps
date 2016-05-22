<?php

namespace School\StudyMaterial\Models;

use Illuminate\Database\Eloquent\Model;

class StudyMaterialModel extends Model
{
    protected $table = 'studymaterial';

    public $timestamps = false;

    protected $fillable = [
        'class_id', 'subject_id', 'teacher_id', 'material_title', 'material_description', 'material_file'
    ];
}
