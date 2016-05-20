{!! Form::open(['route' => ['admin.loop.authority.update',$auth->id], 'role' => 'form' ,'method' => 'PATCH']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">编辑类别</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('types', '类型') !!}
        <div class="radio">
            @foreach (config('loop.loops_authority_types') as $k => $v)
                <label style="margin-right: 15px">
                    @if($k == $auth->types)
                        <input type="radio" name="types" value="{!! $k !!}" checked>
                        @else
                        <input type="radio" name="types" value="{!! $k !!}">
                    @endif
                    {!! $v !!}
                </label>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('title', '权限名称') !!}
        {!! Form::text('title', $auth->title, ['class' => 'form-control', 'placeholder' => '填写权限名称']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('path', '路由') !!}
        {!! Form::text('path', $auth->path, ['class' => 'form-control', 'placeholder' => '填写路由']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('icon', '图标代码') !!}
        {!! Form::text('icon', $auth->icon, ['class' => 'form-control', 'placeholder' => '填写图标标签']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tags', '识别码') !!}
        {!! Form::text('tags', $auth->tags, ['class' => 'form-control', 'placeholder' => '填写识别码']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sort', '排序') !!}
        {!! Form::text('sort', $auth->sort, ['class' => 'form-control', 'placeholder' => '填写序号，数字越小越靠前']) !!}
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.update') }}</button>
</div>
{!! Form::close() !!}

