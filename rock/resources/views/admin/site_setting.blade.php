@extends('admin.layouts.common')
@section('title', 'Site Setting')
@section('headerscripts')
<link href="{{admin_assets}}/css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="{{admin_assets}}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
@stop
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Site Setting</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li>
                <a href="{!!url('admin/site_setting')!!}">General Setting</a>
            </li>
            <li class="active">
                <strong>Site Setting</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            @if($errors->any())
            <div class="alert alert-danger">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{$errors->first()}}
            </div>
            @endif
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {!! \Session::get('success') !!}
            </div>
            @endif

            @if (\Session::has('error'))
            <div class="alert alert-danger">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {!! \Session::get('error') !!}
            </div>
            @endif

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            {!! Form::open(array('method' => 'POST','url' => 'admin/site_setting','class'=>'form-horizontal','files'=>true,'autocomplete' => 'off')) !!}

                            <div class="form-group"><label class="col-sm-2 control-label">Site Title *</label>
                                <div class="col-sm-10">
                                    {!! Form::text('stitle',App\CustomFunction\CustomFunction::decode_input($site_data[0]['site_name']) ,array('class'=>'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Site Email *</label>
                                <div class="col-sm-10">
                                    {!! Form::email('site_email',App\CustomFunction\CustomFunction::decode_input($site_data[0]['site_email']) ,array('class'=>'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Site Number *</label>
                                <div class="col-sm-10">
                                    {!! Form::text('contact_no',App\CustomFunction\CustomFunction::decode_input($site_data[0]['contact_no']) ,array('class'=>'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Site Fax Number *</label>
                                <div class="col-sm-10">
                                    {!! Form::text('fax',App\CustomFunction\CustomFunction::decode_input($site_data[0]['fax']) ,array('class'=>'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Site Logo *</label>
                                <div class="col-sm-10">
                                    {!! Form::file('slogo') !!}
                                    <small>Image will be 200x200</small>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $site_data[0]['sid'] }}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    @if(isset($site_data[0]['slogo']) && !empty($site_data[0]['slogo']))
                                        <img alt="image" style="height:100px;width: 100px;" class="" src="{{URL::asset('uploads/')}}/{!!App\CustomFunction\CustomFunction::decode_input($site_data[0]['slogo'])!!}" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Site Fav Logo *</label>
                                <div class="col-sm-10">
                                    {!! Form::file('sflogo') !!}
                                    <small>Image will be 60x60</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    @if(isset($site_data[0]['sflogo']) && !empty($site_data[0]['sflogo']))
                                        <img alt="image" style="height:100px;width: 100px;" class="" src="{{URL::asset('uploads/')}}/{!!App\CustomFunction\CustomFunction::decode_input($site_data[0]['sflogo'])!!}" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop
@section('footerscripts')
<!-- iCheck -->
<script src="{{admin_assets}}/js/plugins/iCheck/icheck.min.js"></script>
<script src="{{admin_assets}}/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});
</script>
@stop
