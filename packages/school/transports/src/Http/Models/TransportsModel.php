<?php

namespace School\Transports\Http\Models;

use Illuminate\Database\Eloquent\Model;

class TransportsModel extends Model
{
    protected $table = 'transportation';

    public $timestamps = false;

    protected $fillable = [
      'transportTitle', 'transportDescription', 'transportDriverContact', 'transportFare'
    ];
}