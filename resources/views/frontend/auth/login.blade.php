@extends('frontend.layouts.uc')

@section('after-styles-end')
    {!! Html::style('/plugins/iCheck/square/blue.css') !!}
@endsection

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin.dashboard') }}">后台登录</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">登录后才能进行管理</p>

            {!! Form::open(['url' => 'login']) !!}
                <div class="form-group has-feedback">
                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                {!! Form::checkbox('remember') !!} {{ trans('labels.frontend.auth.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        {!! Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                    </div>
                    <!-- /.col -->
                </div>
            {!! Form::close() !!}

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                {!! $socialite_links !!}
            </div>
            <!-- /.social-auth-links -->

            {!! link_to('password/reset', trans('labels.frontend.passwords.forgot_password')) !!}

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

@endsection
@section('after-scripts-end')
    {!! Html::script('/plugins/iCheck/icheck.min.js') !!}
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection