@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('department.Editdepartment')}}</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul class=" navbar-nav mr-auto">
                    @foreach ($errors->all() as $error)
                        <li class="nav-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('department.update', $id) }}" method="post">

            @csrf
            <input name="_method" type="hidden" value="PATCH">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">{{__('department.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('department.Name')}}" required value="{{$department->name}}">
                </div>
            </div>

            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('department.Submit')}}</button>

        </form>
    </div>
@endsection
