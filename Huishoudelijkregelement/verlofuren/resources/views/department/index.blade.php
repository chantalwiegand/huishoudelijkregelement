@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th style="color: #ffffff" scope="col">{{__('department.Id')}}</th>
                <th style="color: #ffffff" scope="col">{{__('department.Name')}}</th>
                <th style="color: #ffffff" scope="col"></th>
                <th style="color: #ffffff" scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($department as  $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>



                    <td>
                        <form method="post" action="{{route('department.edit', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('GET')
                            <button type="submit" value="Edit" class="btn btn-outline-dark">{{__('department.Edit')}}</button>
                        </form>

                    </td>


                    <td>
                        <form method="post" action="{{route('department.destroy', [$data->id])}}">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button type="submit" value="Delete" class="btn btn-outline-dark">{{__('department.Delete')}}</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
