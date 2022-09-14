<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Universitas Islam Indonesia" content="">
    <meta name="UII the Champion" content="">

    <title>UII the Champion</title>
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/agencyB.css') }}" rel="stylesheet">
    
    <link href=" {{ url('css/font-awesome.min.css') }} " rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('datepicker/datepicker3.css')}}">
    

    <script type='text/javascript' data-cfasync='false' 
    src='//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js' 
    data-shr-siteid='0921d4cdcbd7dca8ff89a4b8354fe24f' async='async'></script>

</head>

<body onsubmit="notifikasi()" id="page-top" class="index bg-light-gray">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<div class="navbar-brand"><img class="img-responsive" src="{{asset('logo.png')}}"></div>-->
                <a class="navbar-brand" href="{{ url('/') }}">UII the Champion</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/leaderboard') }}">Leaderboard</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Categories <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu btn-primary" role="menu">
                                <li><a href="{{url('competition/regional')}}"><i class="fa fa-btn fa-book"></i>Regional</a></li>
                                <li><a href="{{url('competition/nasional')}}"><i class="fa fa-btn fa-book"></i>Nasional</a></li>
                                <li><a href="{{url('competition/internasional')}}"><i class="fa fa-btn fa-book"></i>Internasional</a></li>
                            </ul>
                        </li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    @elseif (Auth::user()->role == 'ADMIN')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Categories <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu btn-primary" role="menu">
                                <li><a href="{{url('competition/regional')}}"><i class="fa fa-btn fa-book"></i>Regional</a></li>
                                <li><a href="{{url('competition/nasional')}}"><i class="fa fa-btn fa-book"></i>Nasional</a></li>
                                <li><a href="{{url('competition/internasional')}}"><i class="fa fa-btn fa-book"></i>Internasional</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu btn-primary" role="menu">
                                <li><a href="{{ url('user/profile/') }}/{{Auth::user()->username}}"><i class="fa fa-btn fa-user"></i>My profile</a></li>
                                <li><a href="{{ url('create') }}"><i class="fa fa-btn fa-pencil"></i>new post</a></li>
                                <li><a href="{{ url('user/posts') }}"><i class="fa fa-btn fa-book"></i>My Posts</a></li>
                                <li><a href="{{ url('user/bookmarks') }}"><i class="fa fa-btn fa-star"></i>My Bookmarks</a></li>
                                <li><a href="{{ url('register') }}"><i class="fa fa-btn fa-plus"></i>Register</a></li>
                                <li><a href="{{ url('add-students') }}"><i class="fa fa-btn fa-upload"></i>Upload CSV</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                
                            </ul>
                        </li>
                        @elseif (Auth::user()->role == 'STUDENT')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Categories <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu btn-primary" role="menu">
                                <li><a href="{{url('competition/regional')}}"><i class="fa fa-btn fa-book"></i>Regional</a></li>
                                <li><a href="{{url('competition/nasional')}}"><i class="fa fa-btn fa-book"></i>Nasional</a></li>
                                <li><a href="{{url('competition/internasional')}}"><i class="fa fa-btn fa-book"></i>Internasional</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu btn-primary" role="menu">
                                <li><a href="{{ url('user/profile') }}/{{Auth::user()->username}}"><i class="fa fa-btn fa-user"></i>my profile</a></li>
                                <li><a href="{{ url('create') }}"><i class="fa fa-btn fa-pencil"></i>new post</a></li>
                                <li><a href="{{ url('user/posts') }}"><i class="fa fa-btn fa-book"></i>My Posts</a></li>
                                <li><a href="{{ url('user/bookmarks') }}"><i class="fa fa-btn fa-star"></i>My Bookmarks</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script type="text/javascript" src=" {{ url('jsadmin/javascript.js') }} "></script>
    <script type="text/javascript" src="{{ url('jsadmin/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('datepicker/bootstrap-datepicker.js')}}"></script>

    <script type="text/javascript">
        $(function(){
            $('#date').datepicker({
            autoclose: true,
            todayHighlight:true,
            starDate:-3,
            format:'yyyy-mm-dd'
            })
        });
    </script>
</body>
</html>