@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('user.Edituser')}}</h1>
    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul class=" navbar-nav mr-auto">
                @foreach ($errors->all() as $error)
                    <li class="nav-item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update', $id) }}" method="post" >


        @csrf
        <input name="_method" type="hidden" value="PATCH">


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">{{__('user.Firstname')}}</label>
                <input type="text" class="form-control" name="firstname" placeholder="{{__('user.Firstname')}}" required value="{{$user->firstname}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">{{__('user.Prefix')}}</label>
                <input type="text" class="form-control" name="prefix" placeholder="Prefix" value="{{$user->prefix}}">
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail4">{{__('user.Lastname')}}</label>
                <input type="text" class="form-control" name="lastname" placeholder="{{__('user.Lastname')}}" required value="{{$user->lastname}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail4">{{__('user.Email')}}</label>
                <input type="email" class="form-control" name="email" placeholder="{{__('user.Email')}}" required value="{{$user->email}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="Available_hours">{{__('user.Availablehours')}}</label>
                <input type="number" class="form-control" name="available_hours" placeholder="Availablehours" required value="{{$user->available_hours}}">
            </div>

            {{--<div class="form-group col-md-6">--}}
                {{--<label for="work_hours">{{__('user.Hoursofworkaweek')}}</label>--}}
                {{--<input type="number" class="form-control" name="work_hours" placeholder="{{__('user.Hoursofworkaweek')}}" required value="{{$user->work_hours}}">--}}
            {{--</div>--}}

            <div class="form-group col-md-6">
                <label for="work_hours">{{__('user.Selectarole')}}</label>
                <select name="role_id"  class="custom-select" id="inputGroupSelect01">
                    @foreach(\App\Role::orderBy('name')->get() as $role)
                        <option value="{{$role->id}}" {{$user->role_id == $role->id  ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="department_id" >{{__('user.selectadepartment')}}</label>
                <select name="department_id"  class="custom-select" id="inputGroupSelect01">
                    @foreach(\App\Department::orderBy('name')->get() as $department)
                        <option value="{{$department->id}}" {{$user->department_id == $department->id  ? 'selected' : ''}}>{{$department->name}}</option>
                    @endforeach
                </select>
            </div>





        </div>


        <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('user.Submit')}}</button>


    </form>

    </div>


@endsection
