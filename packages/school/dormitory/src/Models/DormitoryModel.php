<?php

namespace School\Dormitory\Models;

use Illuminate\Database\Eloquent\Model;

class DormitoryModel extends Model
{
    protected $table = 'dormitories';

    public $timestamps = false;

    protected $fillable = [
        'dormitory', 'dormDesc'
    ];
}
