<?php

namespace School\Newsboard\Models;

use Illuminate\Database\Eloquent\Model;

class NewsBoardModel extends Model
{
    protected $table = 'newsboard';

    public $timestamps = false;

    protected $fillable = [
        'newsTitle', 'newsText', 'newsFor', 'newsDate', 'creationDate'
    ];
}
