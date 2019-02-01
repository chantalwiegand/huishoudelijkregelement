@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('freeday.Createfreeday')}}</h1>
        <form action="{{ route('freeday.store') }}" method="post" >

            @csrf

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('freeday.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('freeday.Name')}}" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="startdate">{{__('freeday.Startdate')}}</label>
                    <input type="date" class="form-control" name="startdate" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="enddate">{{__('freeday.Enddate')}}</label>
                    <input type="date" class="form-control" name="enddate" >
                </div>
            </div>

            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('freeday.Submit')}}</button>

        </form>

    </div>


@endsection
