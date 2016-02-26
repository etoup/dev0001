@inject('roles', 'App\Repositories\Backend\Role\RoleRepositoryContract')

@extends ('backend.layouts.master')

@section ('title', trans('menus.backend.access.title'))

@section('page-header')
    <h1>
        {{ trans('menus.backend.access.title') }}
        <small>{{ trans('menus.backend.access.permissions.management') }}</small>
    </h1>
@endsection

@section('after-styles-end')
    {!! Html::style('css/backend/plugin/nestable/jquery.nestable.css') !!}
@stop

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">
                    {{ trans('labels.backend.access.permissions.tabs.groups') }}
                </a>
            </li>
            <li>
                <a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">
                    {{ trans('labels.backend.access.permissions.tabs.permissions') }}
                </a>
            </li>
            <li class="pull-right">
                <a href="#" class="text-muted" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-gear"></i></a>
                <ul class="dropdown-menu" role="menu">
                    @permission('create-permission-groups')
                    <li><a href="{{ route('admin.access.roles.permission-group.create') }}" data-toggle="modal" data-target="#create-group">{{ trans('menus.backend.access.permissions.groups.create') }}</a></li>
                    @endauth
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>

                <div class="modal fade" id="create-group" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="groups" style="padding-top:20px">

                <div class="row">
                    <div class="col-lg-6">

                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> {{ trans('strings.backend.access.permissions.sort_explanation') }}
                        </div><!--alert info-->

                        <div class="dd permission-hierarchy">
                            <ol class="dd-list">
                                @foreach ($groups as $group)
                                    <li class="dd-item" data-id="{!! $group->id !!}">
                                        <div class="dd-handle">{!! $group->name !!} <span class="pull-right">{!! $group->permissions->count() !!} {{ trans('labels.backend.access.permissions.label') }}</span></div>

                                    @if ($group->children->count())
                                        <ol class="dd-list">
                                            @foreach($group->children as $child)
                                                <li class="dd-item" data-id="{!! $child->id !!}">
                                                    <div class="dd-handle">{!! $child->name !!} <span class="pull-right">{!! $child->permissions->count() !!} {{ trans('labels.backend.access.permissions.label') }}</span></div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                    </li>
                                @endforeach
                            </ol>
                        </div><!--master-list-->
                        <div class="clearfix"></div>
                    </div><!--col-lg-4-->

                    <div class="col-lg-6">

                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> {{ trans('strings.backend.access.permissions.edit_explanation') }}
                        </div><!--alert info-->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.groups.table.name') }}</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>
                                            {!! $group->name !!}

                                            @if ($group->permissions->count())
                                                <div style="padding-left:40px;font-size:.8em">
                                                    @foreach ($group->permissions as $permission)
                                                        {!! $permission->display_name !!}<br/>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td>{!! $group->action_buttons !!}</td>
                                    </tr>

                                    @if ($group->children->count())
                                        @foreach ($group->children as $child)
                                            <tr>
                                                <td style="padding-left:40px">
                                                    <em>{!! $child->name !!}</em>

                                                    @if ($child->permissions->count())
                                                        <div style="padding-left:40px;font-size:.8em">
                                                            @foreach ($child->permissions as $permission)
                                                                {!! $permission->display_name !!}<br/>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{!! $child->action_buttons !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--col-lg-8-->
                </div><!--row-->

            </div><!--groups-->

            <div role="tabpanel" class="tab-pane" id="permissions" style="padding-top:20px">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.permissions.table.permission') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.name') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.dependencies') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.users') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.roles') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.group') }}</th>
                            <th style="width: 50px">{{ trans('labels.backend.access.permissions.table.group-sort') }}</th>
                            <th>{{ trans('labels.backend.access.permissions.table.system') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{!! $permission->name !!}</td>
                                <td>{!! $permission->display_name !!}</td>
                                <td>
                                    @if (count($permission->dependencies))
                                        @foreach($permission->dependencies as $dependency)
                                            {!! $dependency->permission->display_name !!}<br/>
                                        @endforeach
                                    @else
                                        <span class="label label-success">{{ trans('labels.general.none') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if (count($permission->users))
                                        @foreach($permission->users as $user)
                                            {!! $user->name !!}<br/>
                                        @endforeach
                                    @else
                                        <span class="label label-danger">{{ trans('labels.general.none') }}</span>
                                    @endif
                                </td>
                                <td>
                                    {!! $roles->findOrThrowException(1)->name !!}<br/>
                                    @if (count($permission->roles))
                                        @foreach($permission->roles as $role)
                                            {!! $role->name !!}<br/>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if ($permission->group)
                                        {!! $permission->group->name !!}
                                    @else
                                        <span class="label label-danger">{{ trans('labels.general.none') }}</span>
                                    @endif
                                </td>
                                <td>{!! $permission->sort !!}</td>
                                <td>{!! $permission->system_label !!}</td>
                                <td>{!! $permission->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pull-left">
                    {{ $permissions->total() }} {{ trans_choice('labels.backend.access.permissions.table.total', $permissions->total()) }}
                </div>

                <div class="pull-right">
                    {{ $permissions->render() }}
                </div>

                <div class="clearfix"></div>

            </div><!--permissions-->

        </div>
        <!-- /.tab-content -->
    </div>

@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/plugin/nestable/jquery.nestable.js') !!}

    <script>
        $(function() {
            var hierarchy = $('.permission-hierarchy');
            hierarchy.nestable({maxDepth:2});
            
            hierarchy.on('change', function() {
                @permission('sort-permission-groups')
                    $.ajax({
                        url : "{!! route('admin.access.roles.groups.update-sort') !!}",
                        type: "post",
                        data : {data:hierarchy.nestable('serialize')},
                        success: function(data) {
                            if (data.status == "OK")
                                toastr.success("{{ trans('strings.backend.access.permissions.groups.hierarchy_saved') }}");
                            else
                                toastr.error("{{ trans('auth.unknown') }}.");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            toastr.error("{{ trans('auth.unknown') }}: " + errorThrown);
                        }
                    });
                @else
                    toastr.error("{{ trans('auth.general_error') }}");
                @endauth
            });
        });
    </script>
@stop
