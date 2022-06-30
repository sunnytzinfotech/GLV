@extends('admin.layouts.common')
@section('title', 'Change Password')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Change Password</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li>
                <a href="javascript:;">General Setting</a>
            </li>
            <li class="active">
                <strong>Change Password</strong>
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

            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <form class="form-horizontal" action="{{action('admin\ChangePasswordController@updatepassword')}}" method="post" enctype="multipart/form-data" autocomplete="off">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Current Password</label>
                            <div class="col-sm-10 col-md-10">
                                {!! Form::password('old_pass',array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10 col-md-10">
                                {!! Form::password('new_pass',array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-10 col-md-10">
                                {!! Form::password('c_new_pass',array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
