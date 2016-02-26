@extends('frontend.layouts.master')

@section('content')

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header" style="margin-left: 15px">
                    <a href="{{ route('frontend.index') }}" class="navbar-brand">前台页面</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        @if (Auth::guest())
                            <li>{!! link_to_route('admin.dashboard', trans('navs.frontend.login')) !!}</li>
                        @else
                            @permission('view-backend')
                            <li>
                                {!! link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) !!}
                            </li>
                            @endauth
                            <li>{!! link_to_route('auth.logout', trans('navs.general.logout')) !!}</li>
                        @endif
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    页面展示
                    <small>Example 2.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
                    <li><a href="#">通用</a></li>
                    <li class="active">页面</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="callout callout-info">
                    <h4>提示</h4>

                    <p>前台预留展示页面...</p>
                </div>

                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://etoup.com" target="_blank">Etoup.com</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
@endsection

@section('after-scripts-end')

@stop