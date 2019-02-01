@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('leavetype.CreateLeaveType')}}</h1>
        <form action="{{ route('leavetype.store') }}" method="post" >


            @if($leavetype->exists)
                @method('PUT')
            @endif

            @csrf




            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('leavetype.Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('leavetype.Name')}}" >
                </div>
                <div class="form-group col-md-12">
                    <label for="description">{{__('leavetype.Description')}}</label>
                    <input type="text" class="form-control" name="description" placeholder="{{__('leavetype.Description')}}" >
                </div>

            </div>





            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('leavetype.Submit')}}</button>

        </form>

    </div>


@endsection
