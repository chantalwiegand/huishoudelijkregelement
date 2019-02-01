@extends('layouts.app')

@section('content')

    <div class="container">
        <form method="get">
        <table class="table">


            <tr>
                <td>
                    <select name="employee"  class="custom-select" id="inputGroupSelect01">
                        <option value>{{__('absence.Employee')}}</option>
                        @foreach(\App\User::orderBy('firstname')->get() as $user)
                            <option {{request()->get('employee') == $user->id ? 'selected' : ''  }} value="{{$user->id}}">{{$user->firstname}} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="year"  class="custom-select" id="inputGroupSelect01">
                        <option value>{{__('absence.Year')}}</option>
                        <option {{request()->get('year') == date('Y') + 1 ? 'selected' : ''  }} value="{{date('Y')+1}}">{{date('Y')+1}}</option>
                        <option {{request()->get('year') == date('Y') ? 'selected' : ''  }} value="{{date('Y')}}">{{date('Y')}}</option>
                        <option {{request()->get('year') == date('Y') - 1 ? 'selected' : ''  }} value="{{date('Y') - 1}}">{{date('Y') - 1}}</option>
                        <option {{request()->get('year') == date('Y') - 2 ? 'selected' : ''  }} value="{{date('Y') - 2}}">{{date('Y') - 2}}</option>
                        <option {{request()->get('year') == date('Y') - 3 ? 'selected' : ''  }} value="{{date('Y') - 3}}">{{date('Y') - 3}}</option>
                        <option {{request()->get('year') == date('Y') - 4 ? 'selected' : ''  }} value="{{date('Y') - 4}}">{{date('Y') - 4}}</option>
                    </select>
                </td>
                <td>
                    <select name="status" class="custom-select" id="inputGroupSelect01">
                        <option value>{{__('absence.Status')}}</option>
                        <option {{request()->get('status') == 'Pending' ? 'selected' : ''  }} value="Pending">Pending</option>
                        <option {{request()->get('status') == 'Approved' ? 'selected' : ''  }} value="Approved">Approved</option>
                        <option {{request()->get('status') == 'Declined' ? 'selected' : ''  }} value="Declined">Declined</option>
                    </select>
                </td>
                <td><input class="btn btn-outline-dark" type="submit" value="{{__('absence.Filter')}}"></td>
            </tr>

            {{--<thead class="thead-dark">--}}
            <tr  style="background-color: #000000">
                <th style="color: #ffffff" scope="col">{{__('absence.Employee')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Startdate')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Enddate')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Hours')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Reason')}}</th>
                <th style="color: #ffffff" scope="col">{{__('absence.Status')}}</th>
            </tr>
            {{--</thead>--}}

            <tbody>

            @foreach($absence as  $data )
                {{--@if($data->user_id == $user->id)--}}
                <tr>
                    <td>{{$data->user->firstname . ' ' . $data->user->prefix . ' ' . $data->user->lastname}}</td>
                    <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                    <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                    <td>{{$data->hoursofleave}}</td>
                    <td>{{$data->leavetype['name']}}</td>
                    <td>{{$data->status}}</td>
                </tr>
                {{--@endif--}}
            @endforeach

            </tbody>
        </table>
        </form>
        {{$absence->appends(request()->input())->links()}}


    </div>

    <script>
        $(function(){
            $('.show-decline').on('click', function(){
                let form = $(this).closest('form');
                form.find('.hide-decline').show();
                $(this).hide();
                return false;
            })
        })
    </script>


@endsection



