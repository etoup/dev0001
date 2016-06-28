@extends('frontend.layouts.master')

@section('content')
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header" style="margin-left: 15px">
                    <a href="{{ route('frontend.index') }}" class="navbar-brand">圈子</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

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
                    手机版
                    <small>v1.0.0</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="callout callout-info">
                    <h4>提示</h4>

                    <p>预留APP二维码下载页面</p>
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
            <strong>Copyright &copy; 2014-2016 <a href="http://ijiangjiu.com" target="_blank">ijiangjiu.com</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
@endsection