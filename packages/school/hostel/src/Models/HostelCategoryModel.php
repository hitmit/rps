<?php

namespace School\Hostel\Models;

use Illuminate\Database\Eloquent\Model;

class HostelCategoryModel extends Model
{
    protected $table = 'hostelcat';

    public $timestamps = false;

    protected $fillable = [
        'catTypeId', 'catTitle', 'catFees', 'catNotes'
    ];
}
