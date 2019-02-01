@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('department.Adddepartment')}}</h1>
        <form action="{{ route('department.store') }}" method="post" >

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
                    <label for="inputEmail4">{{__('department.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('department.Name')}}" value="{{$department->name}}">
                </div>
            </div>



            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('department.Submit')}}</button>

        </form>

    </div>


@endsection
