@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('leavetype.EditLeaveType')}}</h1>

        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul class=" navbar-nav mr-auto">
                    @foreach ($errors->all() as $error)
                        <li class="nav-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('leavetype.update', $id) }}" method="post" >


            @csrf
            <input name="_method" type="hidden" value="PATCH">


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">{{__('leavetype.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('leavetype.Name')}}" required value="{{$leavetype->name}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="description">{{__('leavetype.Description')}}</label>
                    <input type="text" class="form-control" name="description" placeholder="{{__('leavetype.Description')}}" value="{{$leavetype->description}}">
                </div>
            </div>



            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('leavetype.Submit')}}</button>


        </form>

    </div>


@endsection
