@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            {{--<thead class="thead-dark">--}}
            <tr style="background-color: #000000">
                <th style="color: #ffffff" scope="col">{{__('user.Firstname')}}</th>
                <th style="color: #ffffff" scope="col">{{__('user.Prefix')}}</th>
                <th style="color: #ffffff" scope="col">{{__('user.Lastname')}}</th>
                <th style="color: #ffffff" scope="col">{{__('user.Email')}}</th>
                <th style="color: #ffffff" scope="col">{{__('user.Department')}}</th>
                <th style="color: #ffffff" scope="col">{{__('user.Role')}}</th>
                <th style="color: #ffffff" scope="col"></th>
                <th style="color: #ffffff" scope="col"></th>
                <th style="color: #ffffff" scope="col"></th>
            </tr>
            {{--</thead>--}}
            <tbody>
            @foreach($user as  $data)
                <tr>
                    <td><a href="/user/ {{$data->id}}"
                           style="color: #000000; text-decoration: underline">{{$data->firstname}}</a></td>
                    <td>{{$data->prefix}}</td>
                    <td>{{$data->lastname}}</td>
                    <td>{{$data->email}}</td>
                    @if($data->department_id)

                    <td>{{$data->department->name}}</td>

                    @else
                        <td></td>
                    @endif
                    @if($data->role_id)
                    <td>{{$data->role->name}}</td>
                    @else
                        <td></td>
                    @endif

                    <td>
                        <form method="post" action="{{route('user.show', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('GET')
                            <button type="submit" value="View" class="btn btn-outline-dark">{{__('user.View')}}</button>
                        </form>

                    </td>

                    <td>
                        <form method="post" action="{{route('user.edit', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('GET')
                            <button type="submit" value="Edit" class="btn btn-outline-dark">{{__('user.Edit')}}</button>
                        </form>

                    </td>


                    <td>
                        <form method="post" action="{{route('user.destroy', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" value="Delete"
                                    class="btn btn-outline-dark">{{__('user.Delete')}}</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection








{{--<table style="width:100%" border="1">--}}
{{--<tr>--}}
{{--<th>Id</th>--}}
{{--<th>First name</th>--}}
{{--<th>Prefix</th>--}}
{{--<th>Last name</th>--}}
{{--<th>Email</th>--}}
{{--<th>Department</th>--}}
{{--<th>Edit</th>--}}
{{--<th>Delete</th>--}}
{{--</tr>--}}

{{--</table>--}}
