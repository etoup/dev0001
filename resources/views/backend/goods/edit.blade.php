{!! Form::open(['route' => 'admin.goods.store', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">编辑商品</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <div class="form-group">
                {!! Form::label('title', '商品名称') !!}
                {!! Form::text('title', $info->title, ['class' => 'form-control', 'placeholder' => '填写商品名称']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('numbers', '数量') !!}
                {!! Form::text('numbers', $info->numbers, ['class' => 'form-control', 'placeholder' => '填写商品数量']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="form-group">
                {!! Form::label('price', '商品价格') !!}
                {!! Form::text('price', $info->price, ['class' => 'form-control', 'placeholder' => '填写商品价格']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('stocks', '库存') !!}
                {!! Form::text('stocks', $info->stocks, ['class' => 'form-control', 'placeholder' => '填写商品库存']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="form-group">
                {!! Form::label('profiles', '商品简介') !!}
                {!! Form::text('profiles', $info->profiles, ['class' => 'form-control', 'placeholder' => '填写商品简介']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('remark', '备注') !!}
                {!! Form::text('remark', $info->remark, ['class' => 'form-control', 'placeholder' => '填写备注']) !!}
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    {!! Form::hidden('id', $info->id) !!}
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.update') }}</button>
</div>
{!! Form::close() !!}

