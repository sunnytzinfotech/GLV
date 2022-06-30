@extends('admin.layouts.common')
@section('title', 'Profile')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li>
                <a href="{!!url('admin/profile')!!}">General Setting</a>
            </li>
            <li class="active">
                <strong>Profile</strong>
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

                    <form class="form-horizontal" action="{{action('admin\ProfileController@updateprofile')}}" method="post" enctype="multipart/form-data" autocomplete="off">

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="tz-form-group">
                                    <label class="control-label">First Name *</label>
                                    {!! Form::text('user_name',$ud[0]['user_name'],array('class'=>'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <div class="tz-form-group">
                                <label class="control-label">Email *</label>
                                {!! Form::email('email',$ud[0]['email'],array('class'=>'form-control','required')) !!}
                              </div>
                            </div>
                        </div>

                        <!-- <div class="row"> -->
                            <!-- <div class="col-sm-6 col-md-6"> -->
                                <!-- <div class="tz-form-group"> -->
                                    <!-- <label class="control-label">Password</label> -->
                                    <!-- {!! Form::password('password_user',array('class'=>'form-control')) !!} -->
                                    <!-- <span>(Leave blank if no change)</span> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div> -->

                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-0">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
