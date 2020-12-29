@extends('admin.main')
@php
    use Illuminate\Support\Facades\Config;

    $availableStatus = Config::get('zvn.config.status.slider');
    $templateStatus = Config::get('zvn.template.status');
@endphp
@section('content')
    <div class="right_col" role="main">
        <div class="page-header zvn-page-header clearfix">
            <div class="zvn-page-header-title">
                <h3>Create new slider</h3>
            </div>
            <div class="zvn-add-new pull-right">
                <a href="{{ route($controllerName) }}" class="btn btn-info"><i
                        class="fa fa-arrow-left"></i> Back to list slider</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title',['title' => 'Create new item'])
                </div>
            </div>
        </div>
        @include('admin.templates.error')
        <form method="POST" action="http://127.0.0.1:8000/admin/slider/save" accept-charset="UTF-8"
              enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
            @csrf
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="name" type="text" value="{{ $item['name'] }}"
                           id="name">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="description" type="text"
                           value="{{ $item['description'] }}" id="description">
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-6 col-xs-12" id="status" name="status">
                        @if(isset($item['status']))
                            @foreach($availableStatus as $status)
                                @if($templateStatus[$status]['value'] == $item['status'])
                                    <option value="{{ $templateStatus[$status]['value']}}" selected="selected">{{ $templateStatus[$status]['name'] }}</option>
                                @else
                                    <option value="{{ $templateStatus[$status]['value']}}">{{ $templateStatus[$status]['name'] }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="default" selected>Select status</option>\
                            @foreach($availableStatus as $status)
                                <option value="{{ $templateStatus[$status]['value']}}">{{ $templateStatus[$status]['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="link" type="text"
                           value="{{ $item['link'] }}" id="link">
                </div>
            </div>
            <div class="form-group">
                <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb">
                    @if(!empty($item['thumb']))
                        <p style="margin-top: 50px;"><img src="http://127.0.0.1:8000/images/slider/{{ $item['thumb'] }}"
                                                          alt="Ưu đãi học phí" class="zvn-thumb"></p>
                    @endif
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input name="id" type="hidden" value="{{ $item['id'] }}">
                    <input name="thumb_current" type="hidden" value="{{ $item['thumb'] }}">
                    <input class="btn btn-success" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
    <!--end-box-pagination-->
@endsection
