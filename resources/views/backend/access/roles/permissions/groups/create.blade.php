{!! Form::open(['route' => 'admin.access.roles.permission-group.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">创建权限组</h4>
</div>
<div class="modal-body">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.permissions.enter.group_name')]) !!}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.create') }}</button>
</div>
{!! Form::close() !!}