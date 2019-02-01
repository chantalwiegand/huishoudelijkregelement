<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

//    public function absence() {
//        return $this->hasMany('App\Absence');
//    }

    protected $fillable = [
        'firstname', 'prefix', 'lastname', 'email', 'password', 'department', 'work_hours', 'role_id', 'department_id', 'available_hours', 'used_hours'
    ];

    protected $guarded = ['id'];

    protected $table = 'users';

    /*
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        $user = \Auth::user();
        $role = $user->role;

        switch ($permission) {
            case 'add_employee':
                return ($role && $role->name == 'Administratie' || $role->name == 'Afdelingsleider');
                break;
            case 'add_role':
                return ($role && $role->name == 'Administratie');
                break;
            case 'add_free_days':
                return ($role && $role->name == 'Administratie');
                break;
            case 'add_leave_type':
                return ($role && $role->name == 'Administratie');
                break;
            case 'see_requests':
                return ($role && $role->name == 'Administratie' || $role->name == 'Afdelingsleider');
                break;
            case 'add_department':
                return ($role && $role->name == 'Administratie');
                break;
            case 'approve_and_decline':
                return ($role && $role->name == 'Administratie' || $role->name == 'Afdelingsleider');
                break;
            default:
                return false;
                break;
        }

    }

    public function hp($permission)
    {
        return $this->hasPermission($permission);
    }

}
