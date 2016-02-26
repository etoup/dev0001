@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.roles.management'))

@section('page-header')
    <h1>
        {{ trans('menus.backend.access.title') }}
        <small>{{ trans('labels.backend.access.roles.management') }}</small>
    </h1>
@endsection

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.access.roles.list') }}</a></li>
            <li class="pull-right">
                <a href="{{ route('admin.access.roles.create') }}" class="text-muted" data-toggle="tooltip" title="" data-original-title="{{ trans('menus.backend.access.roles.create') }}"><i class="fa fa-plus"></i></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.roles.table.role') }}</th>
                        <th>{{ trans('labels.backend.access.roles.table.permissions') }}</th>
                        <th>{{ trans('labels.backend.access.roles.table.number_of_users') }}</th>
                        <th>{{ trans('labels.backend.access.roles.table.sort') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{!! $role->name !!}</td>
                            <td>
                                @if ($role->all)
                                    <span class="label label-success">All</span>
                                @else
                                    @if (count($role->permissions) > 0)
                                        <div style="font-size:.7em">
                                            @foreach ($role->permissions as $permission)
                                                {!! $permission->display_name !!}<br/>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="label label-danger">{{ trans('labels.general.none') }}</span>
                                    @endif
                                @endif
                            </td>
                            <td>{!! $role->users()->count() !!}</td>
                            <td>{!! $role->sort !!}</td>
                            <td>{!! $role->action_buttons !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        <div class="box-footer">
            {{ trans('labels.backend.access.roles.table.total', ['total' => $roles->total()]) }}

            <div class="pull-right">
                {{ $roles->render() }}
            </div>
        </div>
    </div>
@stop
