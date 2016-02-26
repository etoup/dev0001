@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.permissions.management') . ' | ' . trans('labels.backend.access.permissions.edit'))

@section('before-styles-end')
    {!! Html::style('js/backend/plugin/select2/select2.min.css') !!}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.permissions.management') }}
        <small>{{ trans('labels.backend.access.permissions.edit') }}</small>
    </h1>
@endsection

@section('content')
    {!! Form::model($permission, ['route' => ['admin.access.roles.permissions.update', $permission->id], 'class' => 'form', 'role' => 'form', 'method' => 'PATCH']) !!}

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                    {{ trans('labels.backend.access.permissions.tabs.general') }}
                </a>
            </li>
            <li>
                <a href="#dependencies" aria-controls="dependencies" role="tab" data-toggle="tab">
                    {{ trans('labels.backend.access.permissions.tabs.dependencies') }}
                </a>
            </li>
            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', trans('validation.attributes.backend.access.permissions.name'), ['for' => 'name']) !!}

                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.permissions.enter.name')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('group', trans('validation.attributes.backend.access.permissions.group'), ['for' => 'group']) !!}

                            <select name="group" class="form-control select2" style="width: 100%;">
                                <option value="">{{ trans('labels.general.none') }}</option>

                                @foreach ($groups as $group)
                                    <option value="{!! $group->id !!}" {!! $permission->group_id == $group->id ? 'selected' : '' !!}>{!! $group->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::label('associated_roles', trans('validation.attributes.backend.access.permissions.associated_roles'), ['for' => 'associated_roles']) !!}
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <input type="checkbox" {{$role->id == 1 ? 'disabled' : ''}} {{in_array($role->id, $permission_roles) || ($role->id == 1) ? 'checked' : ""}} value="{{$role->id}}" name="permission_roles[]" id="role-{{$role->id}}" /> <label for="role-{{$role->id}}">{!! $role->name !!}</label>
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.permissions.no_roles') }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('display_name', trans('validation.attributes.backend.access.permissions.display_name'), ['for' => 'display_name']) !!}

                            {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.permissions.enter.display_name')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sort', trans('validation.attributes.backend.access.permissions.group_sort'), ['for' => 'group_sort']) !!}

                            {!! Form::text('sort', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.permissions.enter.group_sort')]) !!}
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="system" {{$permission->system == 1 ? 'checked' : ''}} />
                            {!! Form::label('system', trans('validation.attributes.backend.access.permissions.system'), ['for' => 'system']) !!}
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="dependencies">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    {!! getLanguageBlock('backend.lang.access.roles.permissions.dependencies-explanation') !!}
                </div><!--alert-->

                <div class="row">
                    <div class="col-md-4">

                    </div>
                </div>
                @if (count($permissions))
                    @foreach (array_chunk($permissions->toArray(), 10) as $perm)
                        @foreach ($perm as $p)
                            <?php
                            //Since we are using array format to nicely display the permissions in rows
                            //we will just manually create an array of dependencies since we do not have
                            //access to the relationship to use the lists() function of eloquent
                            //but the relationships are eager loaded in array format now
                            $dependencies = [];
                            $dependency_list = [];
                            if (count($p['dependencies'])) {
                                foreach ($p['dependencies'] as $dependency) {
                                    array_push($dependencies, $dependency['dependency_id']);
                                    array_push($dependency_list, $dependency['permission']['display_name']);
                                }
                            }
                            $dependencies = json_encode($dependencies);
                            $dependency_list = implode(", ", $dependency_list);
                            ?>

                            @if ($p['id'] != $permission->id)
                                <input type="checkbox" value="{{$p['id']}}" name="dependencies[]" data-dependencies="{!! $dependencies !!}" id="permission-{{$p['id']}}" {{ in_array($p['id'], $permission_dependencies) ? 'checked' : '' }} />
                                <label for="permission-{{$p['id']}}" />

                                @if ($p['dependencies'])
                                    <a style="color:black;text-decoration:none;" data-toggle="tooltip" data-html="true" title="<strong>{{ trans('labels.backend.access.permissions.dependencies') }}:</strong> {!! $dependency_list !!}">{!! $p['display_name'] !!} <small><strong>(D)</strong></small></a>
                                @else
                                    {!! $p['display_name'] !!}
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    @else
                    {{ trans('labels.backend.access.permissions.no_permissions') }}
                @endif



            </div>

        </div>
        <!-- /.tab-content -->
        <!-- /.tab-pane -->
        <div class="box-footer">
            <a href="{!! route('admin.access.roles.permissions.index') !!}" class="btn btn-default">{{ trans('buttons.general.cancel') }}</a>
            <button type="submit" class="btn btn-info pull-right">{{ trans('buttons.general.crud.update') }}</button>
        </div>
    </div>
    {!! Form::close() !!}

@stop

@section('after-scripts-end')
    {!! Html::script('js/backend/access/permissions/dependencies/script.js') !!}
    {!! Html::script('js/backend/plugin/select2/select2.full.min.js') !!}
    <script>
        $(".select2").select2();
    </script>
@stop