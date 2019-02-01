@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('role.Editrole')}}</h1>

        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul class=" navbar-nav mr-auto">
                    @foreach ($errors->all() as $error)
                        <li class="nav-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('role.update', $id) }}" method="post" >


            @csrf
            <input name="_method" type="hidden" value="PATCH">


            <div class="input-group mb-3 col-md-6" style="padding: 0;">
            <input type="text" class="form-control" name="name" placeholder="{{__('role.Name')}}"  value="{{$role->name}}">
        </div>


        <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('role.Submit')}}</button>

        </form>

    </div>
@endsection
