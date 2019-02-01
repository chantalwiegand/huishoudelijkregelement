@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{__('absence.Requestleave')}}</h1>
        <h5>{{__('absence.Youvegot')}} {{$user->available_hours}} {{__('absence.Hoursleft')}}</h5>
        @if($errors->any())
            <h4 style="color: limegreen">{{$errors->first()}}</h4>
        @endif
        <form action="{{ route('absence.store') }}" method="post" >

            @csrf

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="hoursofleave">{{__('absence.Hours')}}</label>
                    <input type="text" class="form-control" name="hoursofleave" placeholder="{{__('absence.Hours')}}" >
                </div>
            </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="start_date">{{__('absence.Startdate')}}</label>
                        <input type="date" class="form-control" name="start_date" placeholder="Start date" >
                    </div>
                </div>

            <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="end_date">{{__('absence.Enddate')}}</label>
                        <input type="date" class="form-control" name="end_date" placeholder="End date" >
                    </div>
                </div>

            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="work_hours">{{__('absence.Selectleavetype')}}</label>
                <select name="leavetype_id" class="custom-select" id="inputGroupSelect01">
                    <option>{{__('absence.Selectleavetype')}}</option>
                    @foreach(\App\LeaveType::orderBy('name')->get() as $leavetype)
                        <option value="{{$leavetype->id}}">{{$leavetype->name}}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('absence.Submit')}}</button>

        </form>

    </div>


@endsection
