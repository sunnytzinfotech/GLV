@extends('admin.layouts.common')
@section('title', 'Home Page Portal')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
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
                    <strong>Home Page Portal</strong>
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
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Image</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($portal_category) && !empty($portal_category))
                                    <?php $no = 1;?>
                                    @foreach ($portal_category as $Ckey => $c_value)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td><img alt="image" style="height:50px;width: 50px;" class="" src="{{URL::asset('uploads')}}/{!!App\CustomFunction\CustomFunction::decode_input($c_value['c_image'])!!}"></td>
                                            <td>@if(isset($c_value['c_name']) && !empty($c_value['c_name'])){!! $c_value['c_name'] !!}@endif</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-small btn-success" data-toggle="modal" data-target="#addCategoryModal_{{$Ckey}}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <div class="modal fade" id="addCategoryModal_{{$Ckey}}" tabindex="-1" role="dialog" aria-labelledby="addCategoryName" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" class="form-horizontal" action="{{action('admin\PortalController@editCategory')}}" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                                <input name="id" type="hidden" class="form-control" value="@if(isset($c_value['c_id']) && !empty($c_value['c_id'])){{$c_value['c_id']}}@endif">

                                                                <div class="form-group" style="width: 100%;">
                                                                    <label>Image</label>
                                                                    <input name="file" type="file" class="form-control" value="" accept="image/png, image/jpeg" style="width: 100%;">
                                                                    <input name="old_file" type="hidden" class="form-control" value="@if(isset($c_value['c_image']) && !empty($c_value['c_image'])){!! $c_value['c_image'] !!}@endif">
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Title</label>
                                                                    <input name="title" type="text" class="form-control" value="@if(isset($c_value['c_name']) && !empty($c_value['c_name'])){{$c_value['c_name']}}@endif" style="width: 100%;">
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Color Code</label>
                                                                    <input name="color_code" type="text" class="form-control color_picker" value="@if(isset($c_value['color']) && !empty($c_value['color'])){{$c_value['color']}}@endif" style="width: 100%;">
                                                                    <small>Example:- (#ffffff)</small>
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
                                                <a href="javascript:void(0)" class="btn btn-small btn-danger" onclick="DeleteCategoryData('{{$c_value['c_id']}}');" style="margin-left:5px;">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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
                <form method="post" class="form-horizontal" action="{{action('admin\PortalController@addCategory')}}" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label>Image</label>
                        <input id="logo" name="file" type="file" class="form-control" value="" accept="image/png, image/jpeg" required>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input id="title" name="title" type="text" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label>Color Code</label>
                        <input id="color_code" name="color_code" type="text" class="form-control color_picker" value="#ffffff">
                        <small>Example:- (#ffffff)</small>
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

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content boder-none" style="margin-top:10px;">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <div class="input-group float-right" style="margin-left: auto;">
                                        <a href="{!!url('admin/add-portal')!!}" class="btn btn-sm btn-primary">Add Portal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>logo</th>
                                <th>Title</th>
                                <th>Decription</th>
                                <th>Modal</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($result) && !empty($result))
                                <?php $no = 1;?>
                                @foreach ($result as $key => $value)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td><img alt="image" style="height:50px;width: 50px;" class="" src="{{URL::asset('uploads/modelLogo')}}/{!!App\CustomFunction\CustomFunction::decode_input($value['logo'])!!}"></td>
                                        <td>{!! $value['title'] !!}</td>
                                        <td>{!! $value['decription'] !!} </td>
                                        <td>
                                            @if($value['model'] == 1)
                                                <span class="label label-primary">Yes</span>
                                            @else
                                                <span class="label label-warning-light">No Model</span>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="switch">
                                              <div class="onoffswitch">
                                                <input type="checkbox"  class="onoffswitch-checkbox" id="example1_{{$key}}" @if($value['active'] == 0) onclick="ActionConfim('{{$value["id"]}}');"  @else checked onclick="ActionDeactive('{{$value["id"]}}');" @endif>
                                                <label class="onoffswitch-label" for="example1_{{$key}}">
                                                  <span class="onoffswitch-inner"></span>
                                                  <span class="onoffswitch-switch"></span>
                                                </label>
                                              </div>
                                            </div>

                                            {{--
                                            @if($value['active'] == 0)
                                                <a href="javascript:void(0)" class="btn btn-small btn-primary" onclick="ActionConfim('{{$value["id"]}}');" style="margin-left:5px;">
                                                    Active
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-small btn-warning" onclick="ActionDeactive('{{$value["id"]}}');" style="margin-left:5px;">
                                                    DeActive
                                                </a>
                                            @endif
                                            --}}
                                        </td>
                                        <td>
                                            <a href="{!!url('admin/edit-portal') !!}/{{$value['id'] }}" class="btn btn-small btn-success">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-small btn-danger" onclick="DeleteData('{{$value['id']}}');" style="margin-left:5px;">
                                                <i class="fa fa-trash"></i>
                                            </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({height: 200});

            $('.color_picker').colorpicker();

        });
        function ActionConfim(con_id){
            var tokenData = '{{ csrf_token() }}';
            swal({
                title: 'Are you sure?',
                text: "This Product is active?",
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
                        url: "{{URL::to('admin/active-product')}}",
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
                text: "This Product is Deactive?",
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
                        url: "{{URL::to('admin/active-product-deactive')}}",
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

        function DeleteCategoryData(del_id){
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
                        url: "{{URL::to('admin/delete-portal-category')}}",
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
