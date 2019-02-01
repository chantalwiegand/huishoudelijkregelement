<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{

    protected $fillable = [
        'title', 'description',
    ];

    protected $guarded = ['id'];

    protected $table = 'artikel';

}
