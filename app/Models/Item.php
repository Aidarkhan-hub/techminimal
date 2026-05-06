<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
    ];
}
