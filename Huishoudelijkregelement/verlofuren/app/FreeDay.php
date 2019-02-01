<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreeDay extends Model
{
    protected $fillable = [
        'name', 'startdate', 'enddate'
    ];

    protected $guarded = ['id'];

    protected $table = 'free_days';
}
