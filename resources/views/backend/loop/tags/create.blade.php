{!! Form::open(['route' => 'admin.loop.tags.store', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">创建类别</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('title', '类别名称') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '填写类别名称']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort', '排序') !!}
        {!! Form::text('sort', null, ['class' => 'form-control', 'placeholder' => '填写序号，数字越小越靠前']) !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.create') }}</button>
</div>
{!! Form::close() !!}