<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
<div id="app">


    @if (Auth::check())


        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000000;">
            <a class="navbar-brand" href="{{ url('/') }}" style="color: #ffffff">{{__('app.Homepage')}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/absence/create') }}" style="color: #ffffff">{{__('app.RequestLeave')}}</a>
                    </li>

                    @if(Auth::user()->hasPermission('add_role'))

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/absence') }}" style="color: #ffffff">{{__('app.Monthly')}}</a>
                        </li>

                    @endif

                    @if(Auth::user()->hasPermission('add_employee'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                                {{__('app.Employees')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/user') }}">{{__('app.EmployeeOverview')}}</a>


                                <a class="dropdown-item" href="{{ url('/user/create') }}">{{__('app.AddEmployee')}}</a>


                            </div>
                        </li>
                    @endif

                    @if(Auth::user()->hasPermission('add_role'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                                {{__('app.Roles')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/role') }}">{{__('app.RolesOverview')}}</a>

                                <a class="dropdown-item" href="{{ url('/role/create') }}">{{__('app.AddRoles')}}</a>

                            </div>
                        </li>
                    @endif

                    {{--@if(Auth::user()->hasPermission('add_free_days'))--}}
                        {{--<li class="nav-item dropdown">--}}
                            {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"--}}
                               {{--data-toggle="dropdown"--}}
                               {{--aria-haspopup="true" aria-expanded="false" style="color: #ffffff">--}}
                                {{--{{__('app.FreeDays')}}--}}
                            {{--</a>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
                                {{--<a class="dropdown-item" href="{{ url('/freeday') }}">{{__('app.FreeDaysOverview')}}</a>--}}

                                {{--<a class="dropdown-item" href="{{ url('/freeday/create') }}">{{__('app.AddFreeDays')}}</a>--}}

                            {{--</div>--}}
                        {{--</li>--}}
                    {{--@endif--}}

                    @if(Auth::user()->hasPermission('add_leave_type'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                                {{__('app.LeaveTypes')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/leavetype') }}">{{__('app.LeaveTypesOverview')}}</a>
                                <a class="dropdown-item" href="{{ url('/leavetype/create') }}">{{__('app.AddLeaveTypes')}}</a>
                            </div>
                        </li>
                    @endif

                    @if(Auth::user()->hasPermission('add_department'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                                {{__('app.Departments')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/department') }}">{{__('app.DepartmentsOverview')}}</a>
                                <a class="dropdown-item" href="{{ url('/department/create') }}">{{__('app.AddDepartments')}}</a>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                                     id="navbarDropdownMenuLink" data-toggle="dropdown"
                                                     aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                            {{__('app.Account')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('/change-password') }}">{{__('app.ChangePassword')}}</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}"> {{__('app.Logout')}} </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                                     id="navbarDropdownMenuLink" data-toggle="dropdown"
                                                     aria-haspopup="true" aria-expanded="false" style="color: #ffffff">
                            {{__('app.Language')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('set.language', 'en') }}">{{__('app.English')}}</a>
                            <a class="dropdown-item" href="{{ route('set.language', 'nl') }}">{{__('app.Dutch')}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <input type="hidden" name="_token" id="csrf_token" value="{{csrf_token()}}">

    @endif


    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

</body>
</html>
