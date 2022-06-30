@extends('admin.layouts.common')
@section('title', 'Tippgeber Portal')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Home Page Portal</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Tippgeber Portal</strong>
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
                                <th>Vermittlername</th>
                                {{--<th>Code</th>--}}
                                <th>User Name</th>
                                <th>Last Name</th>
                                <th>Mr or Mrs</th>
                                <th>Date of Birth</th>
                                <th>Phone Number</th>
                                <th>Verify</th>
                                <th>Portal Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($result) && !empty($result))
                                <?php $no = 1;?>
                                @foreach ($result as $key => $value)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>
                                          @if(isset($value['userid']) && !empty($value['userid']))
                                            @php
                                              $id = $value['userid'];
                                              $value_user = App\Models\User::where('id', $id)->first();
                                            @endphp
                                            @if(isset($value_user->user_name) && !empty($value_user->user_name))
                                              {{$value_user->user_name}}
                                            @endif
                                            @if(isset($value_user->last_name) && !empty($value_user->last_name))
                                              {{$value_user->last_name}}
                                            @endif
                                          @endif
                                        </td>
                                        {{--<td>
                                          @if(isset($value['code']) && !empty($value['code']))
                                            {{$value['code']}}
                                          @endif
                                        </td>--}}
                                        <td>@if(isset($value['user_name']) && !empty($value['user_name'])){!! $value['user_name'] !!}@endif</td>
                                        <td>@if(isset($value['last_name']) && !empty($value['last_name'])){!! $value['last_name'] !!}@endif</td>
                                        <td>@if(isset($value['mr_mrs']) && !empty($value['mr_mrs'])){!! $value['mr_mrs'] !!}@endif</td>
                                        <td>@if(isset($value['dob']) && !empty($value['dob'])){!! $value['dob'] !!}@endif</td>
                                        <td>@if(isset($value['phone_number']) && !empty($value['phone_number'])){!! $value['phone_number'] !!}@endif</td>
                                        <td>
                                            @if($value['check_verify'] == 1)
                                                <span class="label label-primary">Yes</span>
                                            @else
                                                <span class="label label-warning-light">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $popup_id = 0;
                                                if(isset($value['popup_id']) && !empty($value['popup_id'])){$popup_id= $value['popup_id'];}
                                                    $popup_data = App\Models\HomePortal::where('id', $popup_id)->first();
                                            @endphp
                                            @if(isset($popup_data->title) && !empty($popup_data->title)){!! $popup_data->title !!}@endif
                                        </td>
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
    <script src="{{admin_assets}}/js/plugins/summernote/summernote.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({height: 200});

        });
    </script>
    <script type="text/javascript">
        $('.table').DataTable();
        function DeleteData(del_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "Are you delete this user detail?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, it!'
            },function (isConfirm){
                if (isConfirm) {
                    var _token= "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/delete-portal')}}",
                        data: {'id':del_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Deleted!", "Deleted successfully.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
    </script>

@stop
