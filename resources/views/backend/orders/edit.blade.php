{!! Form::open(['route' => 'admin.orders.store', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">编辑订单</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        {!! Form::label('status', '状态') !!}
        <select name="status" class="form-control select2" style="width: 100%;">
            @foreach(config('orders.orders_status') as $k => $v)
                @if($k >= $info->status)
                    @if($k == $info->status)
                    <option value="{{ $k }}" selected>{{ $v }}</option>
                    @else
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endif
                @endif
            @endforeach
        </select>
    </div>
    @if($info->status == 1)
    <div class="form-group">
        {!! Form::label('price', '订单金额') !!}
        {!! Form::text('price', $info->price, ['class' => 'form-control', 'placeholder' => '填写订单金额']) !!}
    </div>
    @endif
    @if($info->status <= 10)
        @if($info->users_address)
        <div class="form-group">
            {!! Form::label('address', '收货地址') !!}
            {!! Form::text('address', $info->users_address->address, ['class' => 'form-control', 'placeholder' => '填写收货地址']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('code', '邮编') !!}
            {!! Form::text('code', $info->users_address->code, ['class' => 'form-control', 'placeholder' => '填写邮编']) !!}
        </div>
        @endif
    @endif
</div>
<div class="modal-footer">
    {!! Form::hidden('id', $info->id) !!}
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.update') }}</button>
</div>
{!! Form::close() !!}

{!! Html::script('/plugins/select2/select2.full.min.js') !!}

<script>
    $(".select2").select2();
</script>

