@extends('admin.layouts.common')
@section('title', 'Log User')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')
    @php
        $logstatus = Config::get('logstatus.logstatus');
    @endphp
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Log User</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Log User</strong>
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
                    <div class="ibox-content boder-none" style="margin-top:10px;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>User Name</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($result) && !empty($result))
                                <?php $no = 1;?>
                                @foreach ($result as $key => $value)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>
                                            @foreach($logstatus as $LKey => $log_value)
                                                @if(isset($value['stage']) && !empty($value['stage']) && ($value['stage'] == $LKey))<span class="label label-primary">{{$log_value}}</span>@endif
                                            @endforeach
                                            
                                        </td>
                                        <td>@if(isset($value['user_id']) && !empty($value['user_id'])){!! App\Models\User::emailGet($value['user_id']) !!}@endif</td>
                                        <td>@if(isset($value['updated_at']) && !empty($value['updated_at'])){!! $value['updated_at'] !!}@endif</td>
                                    </tr>
                                    <?php $no++;?>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('footerscripts')
    <script type="text/javascript">
        $('.table').DataTable();
    </script>
@stop
