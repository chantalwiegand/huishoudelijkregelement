@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Role</h1>
        <form action="{{ route('role.store') }}" method="post">


            @if($role->exists)
                @method('PUT')
            @endif

            @csrf
            <div class="input-group mb-3 col-md-6" style="padding: 0;">
                <input type="text" class="form-control" name="name" placeholder="{{__('role.Name')}}">
            </div>
            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('role.Submit')}}
            </button>

        </form>

    </div>


@endsection
