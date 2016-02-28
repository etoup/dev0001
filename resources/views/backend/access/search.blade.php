@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('before-styles-end')
    {!! Html::style('/plugins/select2/select2.min.css') !!}
    {!! Html::style('/plugins/daterangepicker/daterangepicker-bs3.css') !!}
@endsection

@section('page-header')
    <h1>
        {{ trans('menus.backend.access.title') }}

        <small>{{ trans('labels.backend.access.users.management') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">搜索</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        {!! Form::open(['route' => 'admin.access.users.search', 'role' => 'form']) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('name', '用户名') !!}
                        {!! Form::text('name', request('name', $default = null), ['class' => 'form-control', 'placeholder' => '填写用户名']) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('mobile', '手机号码') !!}
                        {!! Form::text('mobile', request('mobile', $default = null), ['class' => 'form-control', 'placeholder' => '填写手机号码']) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('loop_roles', '属性') !!}
                        {!! Form::select('loop_roles', [''=>'全部','10'=>'圈主'], request('loop_roles', $default = null), ['class'=>'form-control select2']) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('date', '创建时间') !!}

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="date" value="{{ request('date', $default = null) }}" class="form-control pull-right" id="reservation">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{ route('admin.access.users.index') }}" class="btn btn-warning pull-left">
                <i class="fa fa-mail-reply-all"></i> 取消搜索
            </a>
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
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.access.users.list') }}</a></li>
            <li><a href="{{ route('admin.access.users.deactivated') }}">{{ trans('menus.backend.access.users.deactivated') }}</a></li>
            <li><a href="{{ route('admin.access.users.deleted') }}">{{ trans('menus.backend.access.users.deleted') }}</a></li>
            <li class="pull-right">
                <a href="{{ route('admin.access.users.create') }}" class="text-muted" data-toggle="tooltip" title="" data-original-title="{{ trans('menus.backend.access.users.create') }}"><i class="fa fa-plus"></i></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.attr') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{!! $user->id !!}</td>
                            <td>{!! $user->name !!}</td>
                            <td>{!! link_to("mailto:".$user->email, $user->email) !!}</td>
                            <td>{!! $user->confirmed_label !!}</td>
                            <td>
                                @if ($user->roles()->count() > 0)
                                    @foreach ($user->roles as $role)
                                        {!! $role->name !!}<br/>
                                    @endforeach
                                @else
                                    {{ trans('labels.general.none') }}
                                @endif
                            </td>
                            <td>
                                @if ($user->loop_roles == 10)
                                    圈主
                                @else
                                    会员
                                @endif
                            </td>
                            <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                            <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                            <td>{!! $user->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            {{ trans('labels.backend.access.users.table.total', ['total' => $users->total()]) }}
            <div class="pull-right">
                {!! $users->render() !!}
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
