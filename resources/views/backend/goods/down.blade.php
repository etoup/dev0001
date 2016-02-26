{!! Form::open(['route' => 'admin.goods.do-down', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">商品下架</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('title', '下架商品') !!}
        {!! Form::text('title', $info->title, ['class' => 'form-control','disabled' => true]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('remark', '下架原因') !!}
        {!! Form::text('remark', null, ['class' => 'form-control', 'placeholder' => '填写商品下架原因']) !!}
    </div>
</div>
<div class="modal-footer">
    {!! Form::hidden('id',$info->id) !!}
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">提交</button>
</div>
{!! Form::close() !!}