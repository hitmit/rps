<?php

namespace School\Accounts\Models;

use Illuminate\Database\Eloquent\Model;

class FeeAllocationModel extends Model
{
    protected $table = 'feeallocation';

    public $timestamps = false;

    protected $fillable = [
        'allocationType', 'allocationId', 'allocationValues'
    ];
}
