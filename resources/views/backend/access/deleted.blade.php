@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.deleted'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.deleted') }}</small>
    </h1>
@endsection

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('admin.access.users.index') }}">{{ trans('labels.backend.access.users.list') }}</a></li>
            <li><a href="{{ route('admin.access.users.deactivated') }}">{{ trans('menus.backend.access.users.deactivated') }}</a></li>
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('menus.backend.access.users.deleted') }}</a></li>
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
                        <th>{{ trans('labels.backend.access.users.table.other_permissions') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($users->count())
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
                                        {{ trans('labels.general.none')}}
                                    @endif
                                </td>
                                <td>
                                    @if ($user->permissions()->count() > 0)
                                        @foreach ($user->permissions as $perm)
                                            {!! $perm->display_name !!}<br/>
                                        @endforeach
                                    @else
                                        {{ trans('labels.general.none') }}
                                    @endif
                                </td>
                                <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                                <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                                <td>
                                    @permission('undelete-users')
                                    <a href="{{route('admin.access.user.restore', $user->id)}}" class="btn btn-xs btn-success" name="restore_user"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="{{ trans('buttons.backend.access.users.restore_user') }}"></i></a>
                                    @endauth

                                    @permission('permanently-delete-users')
                                    <a href="{{route('admin.access.user.delete-permanently', $user->id)}}" class="btn btn-xs btn-danger" name="delete_user_perm"><i class="fa fa-times" data-toggle="tooltip" data-placement="top" title="{{ trans('buttons.backend.access.users.delete_permanently') }}"></i></a>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="9">{{ trans('labels.backend.access.users.table.no_deleted') }}</td>
                    @endif
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
	<script>
		$(function() {
            @permission('permanently-delete-users')
                $("a[name='delete_user_perm']").click(function(e) {
                    e.preventDefault();

                    swal({
                        title: "{{ trans('strings.backend.general.are_you_sure') }}",
                        text: "{{ trans('strings.backend.access.users.delete_user_confirm') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ trans('strings.backend.general.continue') }}",
                        closeOnConfirm: false
                    }, function(isConfirmed){
                        if (isConfirmed){
                            window.location = $("a[name='delete_user_perm']").attr('href');
                        }
                    });
                });
            @endauth

            @permission('undelete-users')
                $("a[name='restore_user']").click(function(e) {
                    e.preventDefault();

                    swal({
                        title: "{{ trans('strings.backend.general.are_you_sure') }}",
                        text: "{{ trans('strings.backend.access.users.restore_user_confirm') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ trans('strings.backend.general.continue') }}",
                        closeOnConfirm: false
                    }, function(isConfirmed){
                        if (isConfirmed){
                            window.location = $("a[name='restore_user']").attr('href');
                        }
                    });
                });
            @endauth
		});
	</script>
@stop
