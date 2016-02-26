{!! Form::open(['route' => 'admin.loop.authority.store', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">创建权限</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('types', '类型') !!}
        <div class="radio">
            @foreach (config('loop.loops_authorith_types') as $k => $v)
                <label style="margin-right: 15px">
                    <input type="radio" name="types" value="{!! $k !!}">
                    {!! $v !!}
                </label>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('title', '权限名称') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '填写权限名称']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('icon', '图标') !!}
        {!! Form::text('icon', null, ['class' => 'form-control', 'placeholder' => '填写图标标签']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('path', '路由') !!}
        {!! Form::text('path', null, ['class' => 'form-control', 'placeholder' => '填写路由']) !!}
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