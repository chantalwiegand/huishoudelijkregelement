@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            {{--<thead class="thead-dark">--}}
            <tr  style="background-color: #000000">
                <th style="color: #ffffff" scope="col"> {{__('freeday.Name')}} </th>
                <th style="color: #ffffff" scope="col">{{__('freeday.Startdate')}}</th>
                <th style="color: #ffffff" scope="col">{{__('freeday.Enddate')}}</th>
                <th style="color: #ffffff" scope="col"></th>
                <th style="color: #ffffff" scope="col"></th>
            </tr>
            {{--</thead>--}}
            <tbody>
            @foreach($freeday as  $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->startdate}}</td>
                    <td>{{$data->enddate}}</td>

                    <td>
                        <form method="post" action="{{route('freeday.edit', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('GET')
                            <button type="submit" value="Edit" class="btn btn-outline-dark">{{__('freeday.Edit')}}</button>
                        </form>

                    </td>


                    <td>
                        <form method="post" action="{{route('freeday.destroy', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" value="Delete" class="btn btn-outline-dark">{{__('freeday.Delete')}}</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
