@extends('layouts.app')
<style>
    .container{
        padding:5%;
    }
    .container .img{
        text-align:center;
    }
    .container .details{
        border-left:3px solid #ded4da;
    }
    .container .details p{
        font-size:15px;
        font-weight:bold;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4 details" style="padding-top: 70px">
                <blockquote>
                    <h1 style="margin-bottom: -2px;">{{$user->firstname .' '. $user->prefix .' '. $user->lastname}}</h1>
                </blockquote>
                    <p>
                        {{__('user.Leavehours')}}: {{$user->available_hours ? $user->available_hours : '-'}}<br>
                        {{__('user.Usedleavehours')}}: {{$user->used_hours ? $user->used_hours : '-'}}<br>
                        {{__('user.Email')}}: {{$user->email}} <br>
                        {{__('user.Department')}}: {{$user->department_id ? $user->department->name : '-'}}<br>
                        {{__('user.Role')}}: {{$user->department_id ? $user->role->name : '-'}}<br>
                    </p>

            </div>
        </div>
    </div>

@endsection
