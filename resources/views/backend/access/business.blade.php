{!! Form::open(['route' => ['admin.access.users.edit-business'], 'role' => 'form' ]) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">
        @if(isset($info->business))
            编辑商家信息
        @else
            创建商家信息
        @endif
    </h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('business_name', '商家姓名') !!}
        @if(isset($info->business))
            {!! Form::text('business_name', $info->business->business_name, ['class' => 'form-control', 'placeholder' => '填写商家姓名']) !!}
            @else
            {!! Form::text('business_name', null, ['class' => 'form-control', 'placeholder' => '填写商家姓名']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('business_mobile', '手机号码') !!}
        @if(isset($info->business))
            {!! Form::text('business_mobile', $info->business->business_mobile, ['class' => 'form-control', 'placeholder' => '填写商家手机号码']) !!}
            @else
            {!! Form::text('business_mobile', null, ['class' => 'form-control', 'placeholder' => '填写商家手机号码']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('business_card', '商家银行卡') !!}
        @if(isset($info->business))
            {!! Form::text('business_card', $info->business->business_card, ['class' => 'form-control', 'placeholder' => '填写商家银行卡']) !!}
            @else
            {!! Form::text('business_card', null, ['class' => 'form-control', 'placeholder' => '填写商家银行卡']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('business_card_bank', '银行卡支行') !!}
        @if(isset($info->business))
            {!! Form::text('business_card_bank', $info->business->business_card_bank, ['class' => 'form-control', 'placeholder' => '填写商家银行卡支行']) !!}
            @else
            {!! Form::text('business_card_bank', null, ['class' => 'form-control', 'placeholder' => '填写商家银行卡支行']) !!}
        @endif
    </div>
</div>
<div class="modal-footer">
    @if(isset($info->business))
        {!! Form::hidden('id',$info->business->id) !!}
    @endif
    {!! Form::hidden('users_id',$info->id) !!}
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.submit') }}</button>
</div>
{!! Form::close() !!}

