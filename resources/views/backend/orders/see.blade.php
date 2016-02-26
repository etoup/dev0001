@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.orders.main'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.orders.main') }}
        <small>{{ trans('labels.backend.orders.list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('admin.orders') }}">{{ trans('labels.backend.orders.list') }}</a></li>
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.orders.details') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-cart-plus"></i> {{ config('orders.orders_status')[$info->status] }}
                            <small class="pull-right">订单时间：{{ $info->created_at }}</small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>


                <!-- Table row -->
                <div class="row">
                    <div class="col-sm-6 table-responsive">
                        <div style="border: 1px solid #EEEEEE; padding: 5px; border-radius: 4px;">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">

                                        <div class="carousel-caption">
                                            First Slide
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

                                        <div class="carousel-caption">
                                            Second Slide
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

                                        <div class="carousel-caption">
                                            Third Slide
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6 table-responsive">
                        <dl>
                            <dt>商品信息</dt>
                            <dd>商品名称：{{ $info->goods->title }}</dd>
                            <dd>商品简介：{{ $info->goods->profiles }}</dd>
                            <dd>价格：{{ $info->goods->price }}</dd>
                            <dd>数量：{{ $info->goods->numbers }}</dd>
                            <dd>库存：{{ $info->goods->stocks }}</dd>
                        </dl>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- info row -->
                <div class="row invoice-info" style="margin-top:20px;">
                    <div class="col-sm-6 invoice-col">
                        <dl>
                            <dt>买家信息</dt>
                            <dd>用户名：{{ $info->users->name }}</dd>
                            <dd>手机号码：{{ $info->users->mobile }}</dd>
                            <dd>地址：{{ $info->users_address->address }}</dd>
                            <dd>邮编：{{ $info->users_address->code }}</dd>
                        </dl>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 invoice-col">
                        @if(isset($info->business))
                            <dl>
                                <dt>卖家信息</dt>
                                <dd>姓名：{{ $info->business->business_name }}</dd>
                                <dd>手机号码：{{ $info->business->business_mobile }}</dd>
                                <dd>卡号：{{ $info->business->business_card }}</dd>
                                <dd>支行：{{ $info->business->business_card_bank }}</dd>
                            </dl>
                            @else
                            <div class="callout callout-warning">
                                <h4>没有卖家信息</h4>

                                <p>请返回订单列表编辑卖家信息</p>
                            </div>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-weixin"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">支付方式</span>
                                <span class="info-box-number">微信支付</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>

                    </div>
                    <div class="col-xs-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-qrcode"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">订单号</span>
                                <span class="info-box-number">{{ $info->orders_numbers }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>

                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-cny "></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">订单金额</span>
                                <span class="info-box-number">{{ $info->price }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
        </div>
        <div class="box-footer">
            <div class="callout callout-info">
                <h4>备注</h4>

                <p>{{ $info->remark }}</p>
            </div>
            <!-- this row will not appear when printing -->
            {{--<div class="row no-print">--}}
                {{--<div class="col-xs-12">--}}
                    {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> 预留按钮</a>--}}
                    {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> 预留按钮--}}
                    {{--</button>--}}
                    {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                        {{--<i class="fa fa-download"></i> 预留按钮--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@stop
