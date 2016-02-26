
{!! Form::open(['route' => 'admin.loop.store', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">创建圈子</h4>
</div>
<div class="modal-body">
    @if($tags->count())
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('title', '圈子名称') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '填写圈子名称']) !!}
                </div>
            </div>

            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('username', '圈主用户名') !!}
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => '填写圈主用户名']) !!}
                </div>
            </div>

            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('loops_tags_id', '圈子类别') !!}
                    <select name="loops_tags_id" class="form-control select2" style="width: 100%;">
                        <option value="" selected="selected">选择类别</option>
                        @foreach($tags as $v)
                            <option value="{{ $v->id }}">{{ $v->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('profiles', '简介') !!}
            {!! Form::text('profiles', null, ['class' => 'form-control', 'placeholder' => '填写圈子简介，限定34字符']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('file', '封面') !!}
            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将照片拖到这里，单次最多可选1张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div><div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="key" id="key" />
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">目录选择</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>圈主</dt>
                            @foreach($catas as $v)
                            <dd style="margin-top: 5px;"> {!! Form::checkbox('catas[]',$v->id,false,['class'=>'catas','id'=>'catas-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>用户</dt>
                            @foreach($catas as $v)
                                <dd style="margin-top: 5px;"> {!! Form::checkbox('catas_user[]',$v->id,false,['class'=>'catas_user','id'=>'catas-user-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">功能区选择</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>圈主</dt>
                            @foreach($funs as $v)
                                <dd style="margin-top: 5px;"> {!! Form::checkbox('funs[]',$v->id,false,['class'=>'funs','id'=>'funs-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>用户</dt>
                            @foreach($funs as $v)
                                <dd style="margin-top: 5px;" class="funs_user"> {!! Form::checkbox('funs_user[]',$v->id,false,['class'=>'funs_user','id'=>'funs-user-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @else
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> 提示</h4>
            圈子类别还没有设置，请先前往 <a href="{{ route('admin.loop.tags.index') }}">设置圈子类别</a>
        </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.create') }}</button>
</div>
{!! Form::close() !!}

{!! Html::script('/plugins/select2/select2.full.min.js') !!}
{!! Html::script('/plugins/iCheck/icheck.min.js') !!}
<script>
    var _token = '{{ csrf_token() }}';

    $(".select2").select2();

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $('input').on('ifChecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
        //alert(event.type + ' callback');
        var val = $(this).val(),name = $(this).attr('class');

        switch(name){
            case 'catas_user':
                    $('#catas-'+val).iCheck('check');
                break;
            case 'funs_user':
                    $('#funs-'+val).iCheck('check');
                break;
        }
    });

    $('input').on('ifUnchecked', function(event){ //ifCreated 事件应该在插件初始化之前绑定
        //alert(event.type + ' callback');
        var val = $(this).val(),name = $(this).attr('class');
        switch(name){
            case 'catas':
                $('#catas-user-'+val).iCheck('uncheck');
                break;
            case 'funs':
                $('#funs-user-'+val).iCheck('uncheck');
                break;
            case 'catas_user':
                $('#catas-'+val).iCheck('uncheck');
                break;
            case 'funs_user':
                $('#funs-'+val).iCheck('uncheck');
                break;
        }
    });
</script>
{!! Html::script('/plugins/webuploader/dist/webuploader.js') !!}
{!! Html::script('/plugins/webuploader/examples/image-upload/upload.js') !!}
