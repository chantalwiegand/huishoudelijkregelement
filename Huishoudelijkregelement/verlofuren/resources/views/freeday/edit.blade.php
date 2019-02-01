@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{__('freeday.Editfreedays')}}</h1>

        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul class=" navbar-nav mr-auto">
                    @foreach ($errors->all() as $error)
                        <li class="nav-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('freeday.update', $id) }}" method="post" >


            @csrf
            <input name="_method" type="hidden" value="PATCH">


            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('freeday.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('freeday.Name')}}" required value="{{$freeday->name}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('freeday.Startdate')}}</label>
                    <input type="date" class="form-control" name="startdate" value="{{$freeday->startdate}}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('freeday.Enddate')}}</label>
                    <input type="date" class="form-control" name="enddate" value="{{$freeday->enddate}}">
                </div>
            </div>

            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('freeday.Submit')}}</button>


        </form>

    </div>


@endsection
