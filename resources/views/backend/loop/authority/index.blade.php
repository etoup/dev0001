@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.loop.main'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.loop.main') }}
        <small>{{ trans('labels.backend.loop.authorith') }}</small>
    </h1>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.loop.authorith_list') }}</a></li>
            <li class="pull-right" data-toggle="tooltip" title="" data-original-title="{{ trans('menus.backend.loop.authorith.create') }}">
                <a href="{{ route('admin.loop.authority.create') }}" data-toggle="modal" data-target="#create" class="text-muted"><i class="fa fa-plus"></i></a>
            </li>
            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> 提示</h4>
                    圈子权限定义APP端圈子页面的目录和功能操作访问权限路由，请不要随便更改路由地址
                </div>
                {{--{{ dp($authorities) }}--}}
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.loop.table.id') }}</th>
                        <th>{{ trans('labels.backend.loop.table.authority_title') }}</th>
                        <th>{{ trans('labels.backend.loop.table.authority_icon') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.loop.table.path') }}</th>
                        <th>{{ trans('labels.backend.loop.table.types') }}</th>
                        <th>{{ trans('labels.backend.loop.table.created') }}</th>
                        <th>{{ trans('labels.backend.loop.table.sort') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($authorities->count())
                        @foreach($authorities as $auth)
                            <tr>
                                <td>{{ $auth->id }}</td>
                                <td>{{ $auth->title }}</td>
                                <td><i class="fa {{ $auth->icon }}"></i></td>
                                <td>{{ $auth->path }}</td>
                                <td>{{ config('loop.loops_authorith_types')[$auth->types] }}</td>
                                <td>{{ $auth->created_at }}</td>
                                <td>{{ $auth->sort }}</td>
                                <td>{!! $auth->action_buttons !!}</td>
                            </tr>
                            <div class="modal fade" id="edit-{{ $auth->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <td colspan="6">{{ trans('labels.backend.table.nolists') }}</td>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            {{ trans('labels.backend.total', ['total' => $authorities->total()]) }}
            <div class="pull-right">
                {{ $authorities->render() }}
            </div>
        </div>
    </div>
@stop
