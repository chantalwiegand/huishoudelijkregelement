@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{__('user.Createuser')}}</h1>
<form action="{{ route('user.store') }}" method="post" >


    @if($user->exists)
        @method('PUT')
    @endif

        @csrf

        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul class=" navbar-nav mr-auto">
                    @foreach ($errors->all() as $error)
                        <li class="nav-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="Firstname">{{__('user.Firstname')}}</label>
            <input type="text" class="form-control" name="firstname" placeholder="{{__('user.Firstname')}}" required value="{{$user->firstname}}">
        </div>

        <div class="form-group col-md-4">
            <label for="Prefix">{{__('user.Prefix')}}</label>
            <input type="text" class="form-control" name="prefix" placeholder="{{__('user.Prefix')}}" value="{{$user->prefix}}">
        </div>

        <div class="form-group col-md-4">
            <label for="Lastname">{{__('user.Lastname')}}</label>
            <input type="text" class="form-control" name="lastname" placeholder="{{__('user.Lastname')}}" required value="{{$user->lastname}}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="Email">{{__('user.Email')}}</label>
            <input type="email" class="form-control" name="email" placeholder="{{__('user.Email')}}" required value="{{$user->email}}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="Password">{{__('user.Password')}}</label>
            <input type="password" class="form-control" name="password" placeholder="{{__('user.Password')}}"  @if(!$user->exists) required  @endif>
        </div>
    </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="Available_hours">{{__('user.Availablehours')}}</label>
                <input type="number" class="form-control" name="available_hours" placeholder="{{__('user.Availablehours')}}" required value="{{$user->available_hours}}">
            </div>

            {{--<div class="form-group col-md-6">--}}
                {{--<label for="work_hours">{{__('user.Hoursofworkaweek')}}</label>--}}
                {{--<input type="number" class="form-control" name="work_hours" placeholder="{{__('user.Hoursofworkaweek')}}" required value="{{$user->work_hours}}">--}}
            {{--</div>--}}
        </div>

            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="work_hours">{{__('user.Selectarole')}}</label>
                <select name="role_id" class="custom-select" id="inputGroupSelect01">
                    <option>{{__('user.Selectarole')}}</option>
                    @foreach(\App\Role::orderBy('name')->get() as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="work_hours">{{__('user.selectadepartment')}}</label>
                <select name="department_id" class="custom-select" id="inputGroupSelect01">
                    <option>{{__('user.selectadepartment')}}</option>
                    @foreach(\App\Department::orderBy('name')->get() as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
            </div>









        <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">Submit</button>


</form>

</div>


@endsection
