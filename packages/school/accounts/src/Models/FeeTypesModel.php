<?php

namespace School\Accounts\Models;

use Illuminate\Database\Eloquent\Model;

class FeeTypesModel extends Model
{
    protected $table = 'feetype';

    public $timestamps = false;

    protected $fillable = [
        'feeTitle', 'feeDefault', 'feeNotes'
    ];
}
