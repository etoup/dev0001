
{!! Form::open(['route' => 'admin.loop.update', 'role' => 'form']) !!}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">编辑圈子</h4>
</div>
<div class="modal-body">
    @if($tags->count())
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('title', '圈子名称') !!}
                    {!! Form::text('title', $info->title, ['class' => 'form-control', 'placeholder' => '填写圈子名称']) !!}
                </div>
            </div>

            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('username', '圈主用户名') !!}
                    {!! Form::text('username', $info->users->name, ['class' => 'form-control', 'placeholder' => '填写圈主用户名']) !!}
                </div>
            </div>

            <div class="col-lg-4 col-xs-4">
                <div class="form-group">
                    {!! Form::label('loops_tags_id', '圈子类别') !!}
                    <select name="loops_tags_id" class="form-control select2" style="width: 100%;">
                        <option value="" selected="selected">选择类别</option>
                        @foreach($tags as $v)
                            @if($v->id == $info->loops_tags_id)
                                <option value="{{ $v->id }}" selected>{{ $v->title }}</option>
                                @else
                                <option value="{{ $v->id }}">{{ $v->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('profiles', '简介') !!}
            {!! Form::text('profiles', $info->profiles, ['class' => 'form-control', 'placeholder' => '填写圈子简介，限定34字符']) !!}
        </div>

        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">重新上传</a></li>
                <li><a href="#tab_2" data-toggle="tab">封面</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
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
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @if(isset($info->pictures))
                        <div id="reset_img">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $info->pictures->path }}" alt="{{ $info->title }}" class="img-thumbnail" />
                                </div>
                            </div>
                        </div>
                        @else
                        <button type="button" class="btn bg-orange margin">没有设置封面</button>
                    @endif
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

        @if(isset($info->pictures))
            {!! Form::hidden('key', $info->pictures->key, ['id'=>'key']) !!}
            {!! Form::hidden('pictures_id', $info->pictures->id) !!}
            @else
            {!! Form::hidden('key', null, ['id'=>'key']) !!}
        @endif

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
                            @foreach($catas_loop as $v)
                            <dd style="margin-top: 5px;"> {!! Form::checkbox('catas[]',$v->id,$v->select,['class'=>'catas','id'=>'catas-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>用户</dt>
                            @foreach($catas_user as $v)
                                <dd style="margin-top: 5px;"> {!! Form::checkbox('catas_user[]',$v->id,$v->select,['class'=>'catas_user','id'=>'catas-user-'.$v->id]) !!} {{ $v->title }}</dd>
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
                            @foreach($funs_loop as $v)
                                <dd style="margin-top: 5px;"> {!! Form::checkbox('funs[]',$v->id,$v->select,['class'=>'funs','id'=>'funs-'.$v->id]) !!} {{ $v->title }}</dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <dl>
                            <dt>用户</dt>
                            @foreach($funs_user as $v)
                                <dd style="margin-top: 5px;" class="funs_user"> {!! Form::checkbox('funs_user[]',$v->id,$v->select,['class'=>'funs_user','id'=>'funs-user-'.$v->id]) !!} {{ $v->title }}</dd>
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
    {!! Form::hidden('id', $info->id) !!}
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('buttons.general.crud.update') }}</button>
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
