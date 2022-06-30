@extends('admin.layouts.common')
@section('title', 'User')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li class="active">
                <strong>User</strong>
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
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="row">
                        <h2 class="ml-3 mb-3">User Profile Information</h2>
                        <form method="post" class="form-horizontal" action="">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nachname</label>
                                    <input id="user_name" name="user_name" type="text" class="form-control" value="@if(isset($user->user_name) && !empty($user->user_name)){{$user->user_name}}  @endif">
                                </div>
                                <div class="form-group">
                                    <label>Vorname</label>
                                    <input id="last_name" name="last_name" type="text" class="form-control" value="@if(isset($user->last_name) && !empty($user->last_name)){{$user->last_name}}  @endif">
                                </div>
                                <div class="form-group">
                                    <label>Telefon</label>
                                    <input id="phone" name="phone" type="text" class="form-control" value="@if(isset($user->phone) && !empty($user->phone)){{$user->phone}}  @endif">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Anmerkung</label>
                                    <input id="note" name="note" type="text" class="form-control" value="@if(isset($user->note) && !empty($user->note)){{$user->note}}  @endif">
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input id="email" name="email" type="text" class="form-control" value="@if(isset($user->email) && !empty($user->email)){{$user->email}}  @endif">
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input id="email" name="email" type="text" class="form-control" value="@if(isset($user->email) && !empty($user->email)){{$user->email}}  @endif">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 ml-3">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@stop

@section('footerscripts')
    <script src="{{admin_assets}}/js/plugins/summernote/summernote.min.js"></script>

@stop
