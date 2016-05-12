<?php

namespace School\Events\Models;

use Illuminate\Database\Eloquent\Model;

class EventsModel extends Model
{
    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'eventTitle', 'eventDescription', 'eventFor', 'enentPlace', 'eventDate'
    ];
}
