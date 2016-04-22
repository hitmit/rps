<?php

namespace School\Academic\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $table = 'academicyear';

    public $timestamps = false;

    protected $fillable = [
      'yearTitle', 'isDefault'
    ];
}
