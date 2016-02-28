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
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.loop.main') }}
        <small>{{ trans('labels.backend.loop.list') }}</small>
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
        {!! Form::open(['route' => 'admin.loop.search', 'role' => 'form']) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('title', '圈子名称') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => '填写圈子名称']) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('name', '圈主用户名') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => '填写圈主用户名']) !!}
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('loops_tags_id', '圈子类别') !!}
                        <select name="loops_tags_id" id="loops_tags_id" class="form-control select2">
                            <option value="" selected="selected">全部</option>
                            @foreach($tags as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <div class="form-group">
                        {!! Form::label('date', '最后消息时间') !!}

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
            <button type="reset" class="btn btn-warning pull-left">
                <i class="fa fa-circle-o"></i> 重置
            </button>
            <button type="button" id="export" class="btn btn-success pull-right" style="margin-left: 5px;">
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
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.loop.list') }}</a></li>
            <li class="pull-right" data-toggle="tooltip" title="" data-original-title="{{ trans('menus.backend.loop.create') }}">
                <a href="{{ route('admin.loop.create') }}" data-toggle="modal" data-target="#create" class="text-muted"><i class="fa fa-plus"></i></a>
            </li>
            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                @if($liveness)
                <div class="callout callout-success">
                    <h4>圈子活跃度成功更新</h4>

                    <p>圈子活跃度会每{{ config('loop.expires') }}分钟更新一次，APP端会根据活跃度排序，根据需要调整缓存时间</p>
                </div>
                @endif
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.loop.table.id') }}</th>
                        <th>{{ trans('labels.backend.loop.table.title') }}</th>
                        <th>{{ trans('labels.backend.loop.table.username') }}</th>
                        <th>{{ trans('labels.backend.loop.table.diaries') }}</th>
                        <th>{{ trans('labels.backend.loop.table.users') }}</th>
                        <th>{{ trans('labels.backend.loop.table.liveness') }}</th>
                        <th>{{ trans('labels.backend.loop.table.last_msg_time') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.loop.table.created') }}</th>
                        <th>{{ trans('labels.backend.loop.table.tags_title') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--{{ dd($loops) }}--}}
                        @if ($loops->count())
                            @foreach($loops as $loop)
                                <tr>
                                    <td>{{ $loop->id }}</td>
                                    <td>{{ $loop->title }}</td>
                                    <td>{{ $loop->users->name }}</td>
                                    <td>{{ $loop->diaries }}</td>
                                    <td>{{ $loop->members}}</td>
                                    <td>{{ $loop->liveness }}</td>
                                    <td>{{ $loop->last_msg_time }}</td>
                                    <td>{{ $loop->created_at }}</td>
                                    <td>
                                        @if($loop->loops_tags)
                                            {{ $loop->loops_tags->title }}
                                            @else
                                            NULL
                                        @endif
                                    </td>
                                    <td>{!! $loop->action_buttons !!}</td>
                                </tr>
                                <div class="modal fade" id="edit-{{ $loop->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <td colspan="10">{{ trans('labels.backend.table.nolists') }}</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            {{ trans('labels.backend.total', ['total' => $loops->total()]) }}
            <div class="pull-right">
                {{ $loops->render() }}
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


        $('#export').on('click',function(){
            var path = "{{ Route('admin.loop.export') }}";
            $('form:first').attr({'action':path,'method':'post','target':'_blank'}).submit();
        });
    </script>
@endsection
