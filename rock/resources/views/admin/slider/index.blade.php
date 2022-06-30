@extends('admin.layouts.common')
@section('title', 'Home Page Portal')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Home Page Slider</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Home Page Slider</strong>
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
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Slide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($result) && !empty($result))
                                    <?php $no = 1;?>
                                    @foreach ($result as $Ckey => $c_value)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td><img alt="image" style="height:50px;width: 50px;" class="" src="{{URL::asset('uploads')}}/{!!App\CustomFunction\CustomFunction::decode_input($c_value['image'])!!}"></td>
                                            <td>@if(isset($c_value['text_1']) && !empty($c_value['text_1'])){!! $c_value['text_1'] !!}@endif</td>
                                            <td>@if(isset($c_value['text_2']) && !empty($c_value['text_2'])){!! $c_value['text_2'] !!}@endif</td>
                                            <td>
                                                @if($c_value['status'] == '1')
                                                <span class="label label-primary">Active</span>
                                                @else
                                                <span class="label label-warning-light">Deactive</span>
                                                @endif
                                            </td>
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
                                                            <form method="post" class="form-horizontal" action="{{action('admin\HomeSliderController@editSlider')}}" enctype="multipart/form-data" autocomplete="off">
                                                                <div class="modal-body">
                                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                                                <input name="id" type="hidden" class="form-control" value="@if(isset($c_value['id']) && !empty($c_value['id'])){{$c_value['id']}}@endif">

                                                                <div class="form-group" style="width: 100%;">
                                                                    <label>Image</label>
                                                                    <input name="file" type="file" class="form-control" value="" accept="image/png, image/jpeg" style="width: 100%;">
                                                                    <input name="old_file" type="hidden" class="form-control" value="@if(isset($c_value['image']) && !empty($c_value['image'])){!! $c_value['image'] !!}@endif">
                                                                </div>

                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Title</label>
                                                                    <input name="text_1" type="text" class="form-control" value="@if(isset($c_value['text_1']) && !empty($c_value['text_1'])){{$c_value['text_1']}}@endif" style="width: 100%;">
                                                                </div>
                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label>Sub Title</label>
                                                                    <input name="text_2" type="text" class="form-control" value="@if(isset($c_value['text_2']) && !empty($c_value['text_2'])){{$c_value['text_2']}}@endif" style="width: 100%;">
                                                                </div>
                                                                <div class="form-group" style="width: 100%;margin-top: 10px;">
                                                                    <label><input type="radio" name="status" value="1" @if($c_value['status'] == '1') checked @endif> Active</label>
                                                                    <label><input type="radio" name="status" value="0" @if($c_value['status'] == '0') checked @endif> Deactive</label>
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
                                                <a href="javascript:void(0)" class="btn btn-small btn-danger" onclick="DeleteData('{{$c_value['id']}}');" style="margin-left:5px;">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Slide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" class="form-horizontal" action="{{action('admin\HomeSliderController@addSlider')}}" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label>Image</label>
                        <input name="file" type="file" class="form-control" value="" accept="image/png, image/jpeg" required>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input name="text_1" type="text" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label>Sub Title</label>
                        <input name="text_2" type="text" class="form-control" value="">
                    </div>

                    <div class="form-group" style="width: 100%;margin-top: 10px;">
                        <label><input type="radio" name="status" value="1" checked> Active</label>
                        <label><input type="radio" name="status" value="0" > Deactive</label>
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
                        url: "{{URL::to('admin/delete-slider')}}",
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
