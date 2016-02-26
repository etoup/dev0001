@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.goods.main'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.goods.main') }}
        <small>{{ trans('labels.backend.goods.look') }}</small>
    </h1>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.goods.look_list') }}</a></li>
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
                        <th>所有者</th>
                        <th>创建时间</th>
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
                                <td>{{ $g->users->name }}</td>
                                <td>{{ $g->created_at }}</td>
                                <td>{!! $g->look_buttons !!}</td>
                            </tr>
                            <div class="modal fade" id="edit-{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog">
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
        });
    </script>
@stop
