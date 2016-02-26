@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.loop.main'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.loop.tags') }}
        <small>{{ trans('labels.backend.loop.tags_list') }}</small>
    </h1>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">{{ trans('labels.backend.loop.tags_list') }}</a></li>
            <li class="pull-right" data-toggle="tooltip" title="" data-original-title="{{ trans('menus.backend.loop.create_tags') }}">
                <a href="{{ route('admin.loop.tags.create') }}" data-toggle="modal" data-target="#create" class="text-muted"><i class="fa fa-plus"></i></a>
            </li>
            <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.loop.table.id') }}</th>
                        <th>{{ trans('labels.backend.loop.table.tags_title') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.loop.table.loops') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.loop.table.created') }}</th>
                        <th>{{ trans('labels.backend.loop.table.sort') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{--{{ dd($tags) }}--}}
                        @if ($tags->count())
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->title }}</td>
                                    <td>{{ $tag->loops }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td>{{ $tag->sort }}</td>
                                    <td>{!! $tag->action_buttons !!}</td>
                                </tr>
                                <div class="modal fade" id="edit-tags-{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <td colspan="6">{{ trans('labels.backend.table.nolists') }}</td>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer">
            {{ trans('labels.backend.total', ['total' => $tags->total()]) }}
            <div class="pull-right">
                {{ $tags->render() }}
            </div>
        </div>
    </div>
@stop
