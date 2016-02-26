@extends('frontend.layouts.uc')

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin.dashboard') }}">重置密码</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">填写注册时的邮箱地址</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {!! Form::open(['url' => 'password/email']) !!}
                <div class="form-group has-feedback">
                    {!! Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="{{ route('auth.login') }}" class="btn btn-default btn-flat">{{ trans('labels.frontend.passwords.goback') }}</a>
                    </div>
                    <div class="col-xs-4">
                        {!! Form::submit(trans('labels.frontend.passwords.send_password_reset_link_button'), ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
