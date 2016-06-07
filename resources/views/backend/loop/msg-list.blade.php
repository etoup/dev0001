@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.loop.main'))

@section('before-styles-end')
    {!! Html::style('/plugins/select2/select2.min.css') !!}
    {!! Html::style('/plugins/daterangepicker/daterangepicker-bs3.css') !!}
@endsection

@section('after-styles-end')
    {!! Html::style('/plugins/webuploader/css/webuploader.css') !!}
    {!! Html::style('/plugins/webuploader/examples/image-upload/style.css') !!}
    {!! Html::style('/plugins/iCheck/square/blue.css') !!}
    {!! Html::style('/icons/iconfont.css') !!}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.loop.main') }}
        <small>{{ trans('labels.backend.loop.msg') }}</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{!! access()->user()->picture !!}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $info->users->name }}</h3>

                    <p class="text-muted text-center">{{ $info->users->created_at }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>等级</b> <a class="pull-right">{{ trans('labels.backend.loop.owner') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>邮箱</b> <a class="pull-right">{{ $info->users->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>电话</b> <a class="pull-right">{{ $info->users->mobile }}</a>
                        </li>
                    </ul>

                    <a href="{{ route('admin.access.user.change-password', $info->users->id) }}" class="btn btn-primary btn-block"><b>{{ trans('buttons.backend.access.users.change_password') }}</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.loop.info') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> 标题</strong>

                    <p class="text-muted">
                        {{ $info->title }}
                    </p>

                    <hr>


                    <strong><i class="fa fa-sitemap margin-r-5"></i> 等级</strong>

                    <p class="text-muted">
                        @if(isset($info->loops_tags->title))
                            {{ $info->loops_tags->title }}
                            @else
                            NULL
                        @endif
                    </p>

                    <hr>


                    <strong><i class="fa fa-calendar-plus-o margin-r-5"></i> 创建时间</strong>

                    <p class="text-muted">{{ $info->created_at }}</p>

                    <hr>

                    <strong><i class="fa fa-bullhorn margin-r-5"></i> 简介</strong>

                    <p>{{ $info->profiles }}</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">搜索</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                {!! Form::open(['route' => 'admin.loop.msg-search', 'role' => 'form']) !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-4 col-xs-4">
                            <div class="form-group">
                                {!! Form::label('loops_authority_id', '类别') !!}
                                <select name="loops_authority_id" class="form-control select2">
                                    <option value="" selected="selected">全部</option>
                                    @foreach($authority as $k => $v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xs-8">
                            <div class="form-group">
                                {!! Form::label('date', '消息时间') !!}

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" class="form-control pull-right" id="reservation">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {!! Form::hidden('id',$info->id) !!}
                    <button type="reset" class="btn btn-warning pull-left">
                        <i class="fa fa-circle-o"></i> 重置
                    </button>
                    <button type="button" class="btn btn-success pull-right" style="margin-left: 5px;">
                        <i class="fa fa-download"></i> 导出
                    </button>
                    <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px;">
                        <i class="fa fa-search"></i> 搜索
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#timeline" data-toggle="tab">{{ trans('labels.backend.loop.msg-list') }}</a></li>
                    <li><a href="{{ route('admin.loop') }}">{{ trans('labels.backend.loop.list') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="timeline">



                        @if(count($msgs))
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                @foreach($msgs as $val)
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                      {{ $val->date_node }}
                                    </span>
                                </li>
                                    <!-- /.timeline-label -->
                                    @foreach($val->li as $v)
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa iconfont bg-blue" data-toggle="tooltip" title="" data-original-title="{{ $v->loops_authority->title }}">&#{{ $v->loops_authority->icon }};</i>

                                        <div class="timeline-item" style="background: #f0f0f0;">
                                            <span class="time"><i class="fa fa-clock-o"></i> {{ $v->created_at->diffForHumans() }}</span>

                                            <h3 class="timeline-header" style="border-bottom-color:#dddddd;"><i class="fa fa-user"></i> <a href="#">{{ $v->users->name }}</a> {{ $v->created_at }}发布</h3>

                                            <div class="timeline-body">
                                                @if($v->loops_authority->tags == 'my-img' || $v->loops_authority->tags == 'my-photo' || $v->loops_authority->tags == 'my-share')
                                                    <img src="{{ $v->contents }}" alt="{{ $v->loops_authority->title }}" />
                                                    @else
                                                   {{ $v->contents }}
                                                @endif

                                            </div>
                                            <div class="timeline-footer">
                                                <a href="{{ route('admin.loop.msg-destroy', $v->id) }}" class="btn btn-danger btn-xs" data-method="delete">删除</a>
                                                @if($v->loops_authority->title == '照片')
                                                    <div class="pull-right">
                                                        <i class="fa fa-heart-o"></i> 28
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    @endforeach
                                @endforeach

                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>

                            @else
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> 提示</h4>
                                该圈子还没有消息哟
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    {{ trans('labels.backend.total_days', ['total' => $msgs->total()]) }}
                    <div class="pull-right">
                        {{ $msgs->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    {!! Html::script('/plugins/select2/select2.full.min.js') !!}
    {!! Html::script('/plugins/daterangepicker/moment.min.js') !!}
    {!! Html::script('/plugins/daterangepicker/daterangepicker.js') !!}
    <script>
        $(".select2").select2();
        $('#reservation').daterangepicker({
            format:'YYYY/MM/DD',
            locale:{
                applyLabel:'确定',
                cancelLabel:'关闭',
                fromLabel: '从',
                toLabel: '至'
            }
        });
    </script>
@endsection