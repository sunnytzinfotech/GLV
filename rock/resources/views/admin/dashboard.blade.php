@extends('admin.layouts.common')
@section('title', 'Dashboard')
@section('headerscripts')
<link href="{{admin_assets}}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@stop
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dashboard</h2>

    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight dashboard">
    <div class="row">
      <div class="col-lg-3">
        <a href="{!!url('admin/user-detail')!!}">
          <div class="ibox ">
              <div class="ibox-title" style="padding-bottom: 40px;">
                  <span class="label label-success float-right" style="font-size: 20px;">{{$useractive_count}}</span>
              </div>
              <div class="ibox-content">
                  <h1 class="no-margins"></h1>
                  <small>User Active</small>
              </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3">
        <a href="{!!url('admin/user-detail')!!}">
          <div class="ibox ">
              <div class="ibox-title" style="padding-bottom: 40px;">
                  <span class="label label-success float-right" style="font-size: 20px;">{{$userdeactive_count}}</span>
              </div>
              <div class="ibox-content">
                  <h1 class="no-margins"></h1>
                  <small>User DeActive</small>
              </div>
          </div>
        </a>
      </div>

    </div>
</div>
@stop

@section('footerscripts')
<script src="{{admin_assets}}/js/plugins/dataTables/datatables.min.js"></script>

<script>
$(document).ready(function () {
//    $('.dataTables-example').DataTable();
});
</script>
@stop
