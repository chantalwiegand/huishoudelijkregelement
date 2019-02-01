@extends('layouts.app')
<style>
    .form-group{
        padding-left: 1px !important;
    }
</style>
@section('content')
    <div class="container">
        <h1>{{__('user.Changepassword')}}</h1>

                @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                @endif
                @if(Session::has('succes'))
                    <div class="alert alert-succes">{!! Session::get('succes') !!}</div>
                @endif
                @if(Session::has('failure'))
                    <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                @endif

                    <form action="{{route('password.update')}}" method="post" role="form" class="form-horizontal">
                        {{csrf_field()}}

                        <div class="col-md-12 form-group{{$errors->has('old') ? ' has-error' : ''}}">
                            <label for="password">{{__('user.Oldpassword')}}</label>
                            <input id="password" type="password" class="form-control" name="old" placeholder="{{__('user.Oldpassword')}}">

                            @if($errors->has('old'))
                                <span class="help-block">
                                    <strong>{{$errors->first('old')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">{{__('user.Password')}}</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{__('user.Password')}}">

                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group{{$errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm">{{__('user.Confirmpassword')}}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('user.Confirmpassword')}}">

                            @if($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password_confirmation')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-light" style="background-color: #000000; color: #ffffff">{{__('user.Submit')}}</button>
                        </div>

                    </form>



    </div>



@endsection





