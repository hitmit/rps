<?php

namespace School\Hostel\Models;

use Illuminate\Database\Eloquent\Model;

class HostelModel extends Model
{
    protected $table = 'hostel';

    public $timestamps = false;

    protected $fillable = [
        'hostelTitle', 'hostelType', 'hostelAddress', 'hostelManager', 'hostelNotes'
    ];
}
