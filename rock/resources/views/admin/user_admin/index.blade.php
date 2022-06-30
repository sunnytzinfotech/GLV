@extends('admin.layouts.common')
@section('title', 'Admin List')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Admin List</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Admin List</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding:20px 10px 0px">
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
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <div class="input-group float-right" style="margin-left: auto;">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Admin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Frist Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($result) && !empty($result))
                                    <?php $no = 1;?>
                                    @foreach ($result as $Akey => $a_value)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>@if(isset($a_value['user_name']) && !empty($a_value['user_name'])){!! $a_value['user_name'] !!}@endif</td>
                                            <td>@if(isset($a_value['email']) && !empty($a_value['email'])){!! $a_value['email'] !!}@endif</td>
                                            <td>@if(isset($a_value['pass_check']) && !empty($a_value['pass_check'])){!! $a_value['pass_check'] !!}@endif</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-small btn-success" data-toggle="modal" data-target="#addCategoryModal_{{$Akey}}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <div class="modal fade" id="addCategoryModal_{{$Akey}}" tabindex="-1" role="dialog" aria-labelledby="addCategoryName" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" class="form-horizontal" action="{{action('admin\AdminController@updateAdmin')}}" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                                <input name="id" type="hidden" class="form-control" value="@if(isset($a_value->id) && !empty($a_value->id)){{$a_value->id}}  @endif" style="width: 100%;">

                                                                <div class="form-group" style="width: 100%;">
                                                                    <label>Name</label>
                                                                    <input name="user_name" type="text" class="form-control" value="@if(isset($a_value->user_name) && !empty($a_value->user_name)){{$a_value->user_name}}  @endif" required style="width: 100%;">
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Email</label>
                                                                    <input name="email" type="email" class="form-control" value="@if(isset($a_value->email) && !empty($a_value->email)){{$a_value->email}}  @endif" required style="width: 100%;"> 
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Password</label>
                                                                    <input name="password" type="text" class="form-control" value="@if(isset($a_value['pass_check']) && !empty($a_value['pass_check'])){!! $a_value['pass_check'] !!}@endif" style="width: 100%;">
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Confirm Password</label>
                                                                    <input name="c_password" type="text" class="form-control" value="@if(isset($a_value['pass_check']) && !empty($a_value['pass_check'])){!! $a_value['pass_check'] !!}@endif" style="width: 100%;">
                                                                </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($a_value->status == 0)
                                                <a href="javascript:void(0)" class="btn btn-small btn-primary" onclick="ActionConfim('{{$a_value->id}}');" style="margin-left:5px;">
                                                    Active
                                                </a>
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-small btn-warning" onclick="ActionDeactive('{{$a_value->id}}');" style="margin-left:5px;">
                                                    DeActive
                                                </a>
                                                @endif
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

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryName" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" class="form-horizontal" action="{{action('admin\AdminController@addAdmin')}}" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input name="user_name" type="text" class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" value="" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="text" class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input name="c_password" type="text" class="form-control" value="" required>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('footerscripts')
    <script src="{{admin_assets}}/js/plugins/summernote/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
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

        function ActionConfim(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This User is active?",
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
                        url: "{{URL::to('admin/active-admin')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("Actived!", "Admin actived success.", "success");
                                location.reload();
                            }else{
                                swal("Wrong!", "Wron Data Selected.", "error");
                            }
                        }
                    });
                }
            });
        }
        function ActionDeactive(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This User is Deactive?",
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
                        url: "{{URL::to('admin/active-admin-deactive')}}",
                        data: {'id':con_id,'_token':tokenData},
                        success: function(msg){
                            if(msg == '0'){
                                swal("De-Actived!", "Admin Deactived success.", "success");
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
