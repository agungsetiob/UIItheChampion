@extends('layouts.header')
@section('content')
<section id="portfolio1" class="bg-light-gray">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">NIM/NIP</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button><br>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password?</a>or
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Reset Password?</a>
                            </div>
                        </div>
                    </form>
                    <h3>Petunjuk Login</h3>
                    <p>1. Gunakan nim 12523xxx (001-100).</p>
                    <p>2. Password: masukaja.</p>
                    <p>3. Fitur forgot password dan reset password belum dapat digunakan karena keterbatasan layanan yang disediakan oleh hostinger (maklum gratis jadi port-nya diblok sama mereka).</p>
                    <p>4. Setiap nim hanya dapat digunakan untuk satu sesi, jadi apabila gagal login dengan salah satu nim itu berarti nim tersebut sedang digunakan. Silahkan ganti nim yang lain.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="copyright">Copyright &copy; Universitas Islam Indonesia 2016</span>
            </div>
        </div>
    </div>
</footer>
<script src=" {{ url('jsadmin/jquery.js') }} "></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
@endsection
