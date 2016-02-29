@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.goods.main'))

@section('before-styles-end')
    {!! Html::style('/plugins/select2/select2.min.css') !!}
    {!! Html::style('/plugins/daterangepicker/daterangepicker-bs3.css') !!}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.goods.main') }}
        <small>{{ trans('labels.backend.goods.list') }}</small>
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
        {!! Form::open(['route' => 'admin.goods.search', 'role' => 'form']) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4 col-xs-4">
                    <div class="form-group">
                        {!! Form::label('title', '商品名称') !!}
                        {!! Form::text('title', request('title', $default = null), ['class' => 'form-control', 'placeholder' => '填写商品名称']) !!}
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <div class="form-group">
                        {!! Form::label('status', '状态') !!}
                        <select name="status" class="form-control select2">
                            <option value="" selected="selected">全部</option>
                            @foreach($status as $k => $v)
                                @if($k == request('status'))
                                    <option value="{{ $k }}" selected>{{ $v }}</option>
                                    @else
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <div class="form-group">
                        {!! Form::label('date', '发布时间') !!}

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
            <a href="{{ route('admin.goods') }}" class="btn btn-warning pull-left">
                <i class="fa fa-mail-reply-all"></i> 取消搜索
            </a>
            <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px;">
                <i class="fa fa-search"></i> 搜索
            </button>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.goods.search.list') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品名称</th>
                            <th>商品描述</th>
                            <th>价格</th>
                            <th>数量</th>
                            <th>库存</th>
                            <th>状态</th>
                            <th>所有者</th>
                            <th>审核者</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($goods->count())
                        @foreach($goods as $g)
                            <tr>
                                <td>{{ $g->id }}</td>
                                <td>{{ $g->title }}</td>
                                <td>{{ $g->profiles }}</td>
                                <td>{{ $g->price }}</td>
                                <td>{{ $g->numbers }}</td>
                                <td>{{ $g->stocks }}</td>
                                <td>{{ config('goods.goods_status')[$g->status] }}</td>
                                <td>{{ $g->users->name }}</td>
                                <td>{{ $g->name }}</td>
                                <td>{!! $g->action_buttons !!}</td>
                            </tr>
                            <div class="modal fade" id="edit-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="down-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="look-no-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm">
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
            {{ trans('labels.backend.total', ['total' => $goods->total()]) }}
            <div class="pull-right">
                {{ $goods->render() }}
            </div>
        </div>
    </div>
@stop

@section('after-scripts-end')
    {!! Html::script('/plugins/select2/select2.full.min.js') !!}
    {!! Html::script('/plugins/daterangepicker/moment.min.js') !!}
    {!! Html::script('/plugins/daterangepicker/daterangepicker.js') !!}
    <script>
        $(function() {
            $("a[name='look-ok']").click(function(e) {
                e.preventDefault();

                swal({
                    title: "提示",
                    text: "您确定该商品可以通过审核？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是的，通过审核",
                    cancelButtonText: "取消",
                    closeOnConfirm: false
                }, function(isConfirmed){
                    if (isConfirmed){
                        window.location = $("a[name='look-ok']").attr('href');
                    }
                });
            });

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
		});
    </script>
@stop
