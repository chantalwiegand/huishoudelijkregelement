@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        <h1>{{__('home.Hello')}}, {{$user->firstname}}</h1>
                        <h5>{{__('home.YouHaveGot')}} {{  $user->available_hours}} {{__('home.HoursLeft')}} </h5>
                    </div>

                    <div class="card-body">
                        <h1>{{__('home.OwnLeave')}}</h1>

                        <table class="table table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="color: #ffffff" scope="col">{{__('absence.Employee')}}</th>
                                    <th style="color: #ffffff" scope="col">{{__('absence.Startdate')}}</th>
                                    <th style="color: #ffffff" scope="col">{{__('absence.Enddate')}}</th>
                                    <th style="color: #ffffff" scope="col">{{__('absence.Hours')}}</th>
                                    <th style="color: #ffffff" scope="col">{{__('absence.Status')}}</th>
                                </tr>
                            </thead>

                            <tbody>

                            @foreach($absence as  $data)
                                    <tr>
                                        <td>{{$data->firstname . ' ' . $data->prefix . ' ' . $data->lastname}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                                        <td>{{$data->hoursofleave}}</td>
                                        <td>{{$data->status}}</td>
                                    </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <a class="btn btn-outline-dark" style="text-decoration: underline; font-size: 15px; " onMouseOver="this.style.color='#fff'"  onmouseleave="this.style.color= '#000'" href="{{ url('absence/all') }}">{{__('home.AllRequests')}}</a>

                        @if(Auth::user()->hasPermission('approve_and_decline'))
                        <h1 style="padding-top: 20px;">{{__('home.LeaveRequests')}}</h1>
                        <table class="table table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th style="color: #ffffff" scope="col">{{__('absence.Employee')}}</th>
                                <th style="color: #ffffff" scope="col">{{__('absence.Startdate')}}</th>
                                <th style="color: #ffffff" scope="col">{{__('absence.Enddate')}}</th>
                                <th style="color: #ffffff" scope="col">{{__('absence.Hours')}}</th>
                                <th style="color: #ffffff" scope="col"></th>
                                <th style="color: #ffffff" scope="col"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($absence2->sortByDesc('status') as  $data )
                                @if($data->status == 'Pending')
                                    <tr>
                                        <td>{{$data->user->firstname . ' ' . $data->user->prefix . ' ' . $data->user->lastname}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->start_date))}}</td>
                                        <td>{{date('d-m-Y', strtotime($data->end_date))}}</td>
                                        <td>{{$data->hoursofleave}}</td>

                                        @if($data->status == 'Pending' && $data->user->available_hours >= $data->hoursofleave )

                                            <td>
                                                <form method="post" action="{{route('absence.update', [$data->id])}}">
                                                    @method('PUT')
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-outline-dark" name="approved">{{__('absence.Approved')}}</button>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="post" action="{{route('absence.update', [$data->id])}}">
                                                    @method('PUT')
                                                    {{ csrf_field() }}
                                                    <textarea name="decline_reason" class="hide-decline form-control" style="display: none;" required placeholder="Please enter the reason for decline"></textarea>
                                                    <button type="submit" class="btn btn-outline-dark hide-decline" name="declined" style="display: none;">{{__('absence.Declined')}}</button>
                                                    <button type="button" class="btn btn-outline-dark show-decline">{{__('absence.Declined')}}</button>
                                                </form>
                                            </td>

                                        @elseif( $data->user->available_hours < $data->hoursofleave && $data->status == 'Pending')
                                            <td>Employee <br>doesn't have <br>enough leave <br>hours left</td>

                                            <td>
                                                <form method="post" action="{{route('absence.update', [$data->id])}}">
                                                    @method('PUT')
                                                    {{ csrf_field() }}
                                                    <textarea name="decline_reason" class="hide-decline form-control" style="display: none;" required placeholder="Please enter the reason for decline"></textarea>
                                                    <button type="button" class="btn btn-outline-dark show-decline"> {{__('absence.Declined')}} </button>
                                                    <button type="submit" class="btn btn-outline-dark hide-decline" name="declined" style="display: none;">{{__('absence.Declined')}}</button>
                                                </form>
                                            </td>

                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>

                        </table>
                            @endif

                    </div>
                </div>
            </div>
        </div>
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
