@extends('backend.layouts.master')

@section('before-styles-end')
    {!! Html::style(elixir('css/backend-index.css')) !!}
@endsection
@section('page-header')
    <h1>
        {{ trans('menus.backend.sidebar.dashboard') }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $counts['loops_count'] }}<sup style="font-size: 20px">个</sup></h3>
                    <p>圈子总数</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="{{ route('admin.loop') }}" class="small-box-footer">查看详情 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $counts['orders_count'] }}<sup style="font-size: 20px">单</sup></h3>
                    <p>订单总数</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.orders') }}" class="small-box-footer">查看详情 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $counts['goods_count'] }}<sup style="font-size: 20px">件</sup></h3>
                    <p>商品总数</p>
                </div>
                <div class="icon">
                    <i class="fa fa-reorder"></i>
                </div>
                <a href="{{ route('admin.goods') }}" class="small-box-footer">查看详情 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $counts['users_count'] }}<sup style="font-size: 20px">位</sup></h3>
                    <p>用户总数</p>
                </div>
                <div class="icon">
                    <i class="fa  fa-user"></i>
                </div>
                <a href="{{ route('admin.access.users.index') }}" class="small-box-footer">查看详情 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 警告</h4>
        Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
    </div>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> 提示</h4>
        Info alert preview. This alert is dismissable.
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">最新用户</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">8 位新用户</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        @foreach($new_users as $u)
                        <li>
                            <img src="{{ $u->headimgurl }}-128x128.jpg" alt="{{ $u->name }}">
                            <a class="users-list-name" href="#">{{ $u->name }}</a>
                            <span class="users-list-date">{{ $u->created_at->format('y/m/d h:i') }}</span>
                        </li>
                        @endforeach
                    </ul><!-- /.users-list -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ route('admin.access.users.index') }}" class="uppercase">更多用户</a>
                </div><!-- /.box-footer -->
            </div><!--/.box -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">最新商品</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">{{ count($new_goods) }} 件新商品</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach($new_goods as $g)
                        <li class="item">
                            <div class="product-img">
                                <img src="/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title">{{ $g->title }} <span class="label label-warning pull-right">{{ $g->price }}</span></a>
                        <span class="product-description">
                          {{ $g->profiles }}
                        </span>
                            </div>
                        </li><!-- /.item -->
                        @endforeach
                    </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ route('admin.goods') }}" class="uppercase">更多商品</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">最新客服消息</h3>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="{{ count($new_messages) }} 条消息" class="badge bg-yellow">{{ count($new_messages) }}</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        @foreach($new_messages as $k => $m)
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">{{ $m->loops_authority->title }}</span>
                                <span class="direct-chat-timestamp pull-right">{{ $m->created_at->format('Y-m-d h:i:s') }}</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="/img/user{{ $k }}-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                {{ $m->contents }}
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                        @endforeach
                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp pull-left">{{ date('Y-m-d h:i:s') }}</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                圈主的回复内容
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->

                    </div><!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            @foreach($new_goods as $g)
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user1-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                            @endforeach
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user7-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Sarah Doe
                                  <small class="contacts-list-date pull-right">2/23/2015</small>
                                </span>
                                        <span class="contacts-list-msg">I will be waiting for...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user3-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nadia Jolie
                                  <small class="contacts-list-date pull-right">2/20/2015</small>
                                </span>
                                        <span class="contacts-list-msg">I'll call you back at...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user5-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nora S. Vans
                                  <small class="contacts-list-date pull-right">2/10/2015</small>
                                </span>
                                        <span class="contacts-list-msg">Where is your new...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user6-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  John K.
                                  <small class="contacts-list-date pull-right">1/27/2015</small>
                                </span>
                                        <span class="contacts-list-msg">Can I take a look at...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="/img/user8-128x128.jpg">
                                    <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Kenneth M.
                                  <small class="contacts-list-date pull-right">1/4/2015</small>
                                </span>
                                        <span class="contacts-list-msg">Never mind I found...</span>
                                    </div><!-- /.contacts-list-info -->
                                </a>
                            </li><!-- End Contact Item -->
                        </ul><!-- /.contatcts-list -->
                    </div><!-- /.direct-chat-pane -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="发送消息 ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="button" type="button" class="btn btn-warning btn-flat">发送</button>
                          </span>
                        </div>
                    </form>
                </div><!-- /.box-footer-->
            </div><!--/.direct-chat -->

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">最新订单</h3>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="{{ count($new_orders) }} 条新订单" class="badge bg-green">{{ count($new_orders) }}</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>商品</th>
                                <th>买家</th>
                                <th>状态</th>
                                <th>金额</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($new_orders as $o)
                            <tr>
                                <td><a href="＃">{{ $o->orders_numbers }}</a></td>
                                <td>{{ $o->goods->title }}</td>
                                <td>{{ $o->users->name }}</td>
                                <td>
                                    <span class="label label-success">{{ config('orders.orders_status')[$o->status] }}</span>
                                </td>
                                <td>{{ $o->price }}</td>
                            </tr>
                            @endforeach
                            {{--<tr>--}}
                                {{--<td><a href="pages/examples/invoice.html">OR1848</a></td>--}}
                                {{--<td>Samsung Smart TV</td>--}}
                                {{--<td><span class="label label-warning">Pending</span></td>--}}
                                {{--<td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>--}}
                            {{--</tr>--}}

                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="#" class="btn btn-sm btn-info btn-flat pull-left"><i class="fa fa-refresh"></i> 刷新</a>
                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-default btn-flat pull-right">更多订单</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>

    </div>

@endsection

@section('after-scripts-end')
    {!! Html::script(elixir('js/backend-index.js')) !!}
@endsection