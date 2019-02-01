@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            {{--<thead class="thead-dark">--}}
            <tr style="background-color: #000000">
                <th style="color: #ffffff" scope="col">{{__('absence.Employee')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Startdate')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Enddate')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Hours')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Status')}}</th>
                {{--<th style="color: #ffffff" scope="col"></th>--}}
            </tr>
            {{--</thead>--}}
            <tbody>

            @foreach($absence->sortBy('start_date') as  $data)
                @if($data->user_id == $user->id)
                    <tr>
                        <td>{{$data->firstname . ' ' . $data->prefix . ' ' . $data->lastname}}</td>
                        <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                        <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                        <td>{{$data->hoursofleave}}</td>
                        <td>{{$data->status}}</td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>
@endsection


