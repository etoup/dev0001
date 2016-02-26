@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.orders.main'))

@section('before-styles-end')
    {!! Html::style('/plugins/select2/select2.min.css') !!}
    {!! Html::style('/plugins/daterangepicker/daterangepicker-bs3.css') !!}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.orders.main') }}
        <small>{{ trans('labels.backend.orders.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.orders.list') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box">
                    {!! Form::open(['route' => 'admin.loop.update', 'role' => 'form']) !!}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3 col-xs-3">
                                <div class="form-group">
                                    {!! Form::label('title', '订单号') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '填写订单号']) !!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <div class="form-group">
                                    {!! Form::label('name', '商品ID') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '填写商品ID']) !!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <div class="form-group">
                                    {!! Form::label('status', '状态') !!}
                                    {!! Form::select('status', ['1'=>'a','2'=>'b'], null, ['class'=>'form-control select2']) !!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-3">
                                <div class="form-group">
                                    {!! Form::label('date', '创建时间') !!}

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservation">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-success pull-right" style="margin-left: 5px;">
                            <i class="fa fa-download"></i> 导出
                        </button>
                        <button type="button" class="btn btn-primary pull-right" style="margin-left: 5px;">
                            <i class="fa fa-search"></i> 搜索
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>单号</th>
                        <th>商品名称</th>
                        <th>金额</th>
                        <th>买家</th>
                        <th>买家手机</th>
                        <th>收货地址</th>
                        <th>状态</th>
                        <th>卖家</th>
                        <th>卖家手机</th>
                        <th>卖家卡号</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($orders->count())
                        @foreach($orders as $v)
                            <tr>
                                <td>{{ $v->orders_numbers }}</td>
                                <td>{{ $v->goods->title }}</td>
                                <td>{{ $v->price }}</td>
                                <td>{{ $v->users->name }}</td>
                                <td>{{ $v->users->mobile }}</td>
                                <td>{{ $v->users_address->address }}</td>
                                <td>{{ config('orders.orders_status')[$v->status] }}</td>
                                <td>
                                    @if(isset($v->business->business_name))
                                        {{ $v->business->business_name }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($v->business->business_mobile))
                                        {{ $v->business->business_mobile }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($v->business->business_card))
                                        {{ $v->business->business_card }}
                                    @endif
                                </td>
                                <td>{!! $v->action_buttons !!}</td>
                            </tr>
                            <div class="modal fade" id="edit-{{ $v->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
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
            {{ trans('labels.backend.total', ['total' => $orders->total()]) }}
            <div class="pull-right">
                {{ $orders->render() }}
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
