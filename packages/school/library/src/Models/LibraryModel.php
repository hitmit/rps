<?php

namespace School\Library\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryModel extends Model
{
    protected $table = 'booklibrary';

    public $timestamps = false;

    protected $fillable = [
        'bookName', 'bookDescription', 'bookAuthor', 'bookType', 'bookPrice', 'bookFile', 'bookState'
    ];
}
