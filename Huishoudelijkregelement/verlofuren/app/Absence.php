<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{

//    public function user() {
//        return $this->belongsTo('App\User');
//    }

    protected $fillable = [
        'hoursofleave', 'status', 'start_date', 'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leavetype()
    {
        return $this->belongsTo(LeaveType::class);
    }

    protected $guarded = ['id'];

    protected $table = 'absence';


}
