@extends('admin.layouts.common')
@section('title', 'Add Home Page Portal')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/dropzone.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
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
                    <strong>Add Home Page Portal</strong>
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
                            <h2 class="ml-3 mb-3">Add Home Page Portal</h2>
                            <form method="post" class="form-horizontal" action="{{action('admin\PortalController@store')}}" enctype="multipart/form-data" autocomplete="off">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control m-b" name="category_id" id="category_id">
                                        @if(isset($portal_category) && !empty($portal_category))
                                            @foreach ($portal_category as $Ckey => $c_value)
                                                <option data-color="{{$c_value['color']}}" value="@if(isset($c_value['c_id']) && !empty($c_value['c_id'])){!! $c_value['c_id'] !!}@endif">@if(isset($c_value['c_name']) && !empty($c_value['c_name'])){!! $c_value['c_name'] !!}@endif</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>logo</label>
                                        <input id="logo" name="logo" type="file" class="form-control" value="" accept="image/png, image/jpeg" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Decription</label>
                                        <textarea class="form-control" name="decription" id="decription" style="max-width: 100%;min-width: 100%;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Color Code</label>
                                        <input id="color_code" name="color_code" type="text" class="form-control colorpicker" value="#808080">
                                        <small>Example:- (#ffffff)</small>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="margin-top: 30px;">Special Tipps</label>
                                        <input type="checkbox" name="special_tipps" value="1" checked>
                                    </div>
                                    <div class="form-group">
                                        <label style="margin-top: 18px;">Title</label>
                                        <input id="title" name="title" type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="">Price</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input id="price" name="price" type="text" class="form-control" value="">
                                                <small>Example:- (49,- €)</small>
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="price" name="sub_price" type="text" class="form-control" value="">
                                                <small>Example:- (p. A.)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label style="margin-top: 30px;">Open Model</label>
                                        <input type="checkbox" id="model_check" name="model_check" value="1">
                                    </div>
                                </div>
                                <div class="col-lg-12" id="check_model" style="padding: 0;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Blue Button Text</label>
                                                    <input id="blue_btn_text" name="blue_btn_text" type="text" class="form-control" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Blue Button Yellow Text</label>
                                                    <input id="blue_btn_text" name="b_btn_text_2" type="text" class="form-control" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Blue Button Yellow Text After</label>
                                                    <input id="blue_btn_text" name="b_btn_text_3" type="text" class="form-control" value="">
                                                </div>
                                            </div>
                                            <small>Example:- (EMPFEHLEN und <span style="color: #f1b300;">Provision</span> erhalten!)</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Grey Button Text</label>
                                                    <input id="gray_btn_text" name="gray_btn_text" type="text" class="form-control" value="">

                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Grey Button Red Text</label>
                                                    <input id="gray_btn_text" name="g_btn_text_2" type="text" class="form-control" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Grey Button Red Text After</label>
                                                    <input id="gray_btn_text" name="g_btn_text_3" type="text" class="form-control" value="">
                                                </div>
                                            </div>
                                            <small>Example:- (UNVERBINDLICH BERECHNEN <span style="color: #c90d1e;">ohne Provision</span>)</small>
                                        </div>
                                    </div>
                                    {{--<div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Blue Button URL</label>
                                            <input id="blue_btn_url" name="blue_btn_url" type="text" class="form-control" value="">
                                        </div>
                                    </div>--}}
                                    <div class="col-lg-6">
                                        <div class="form-group" style="margin-top: 15px;">
                                            <label>
                                                <input type="radio" value="1" name="optionsRadios" id="optionsRadios_2" checked="">
                                                Iframe
                                            </label>
                                            <label>
                                                <input type="radio" value="0" name="optionsRadios" id="optionsRadios_1">
                                                External URl
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Grey Button URL</label>
                                            <input id="gray_btn_url" name="gray_btn_url" type="text" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Grey Button Iframe</label>
                                            <textarea type="text" class="form-control" name="btn_iframe" rows="4"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Second Blue Button Text</label>
                                                    <input name="s_b_btn_text" type="text" class="form-control" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Second Blue Button Yellow Text</label>
                                                    <input name="s_b_btn_text_2" type="text" class="form-control" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Second Blue Button Yellow Text After</label>
                                                    <input name="s_b_btn_text_3" type="text" class="form-control" value="">
                                                </div>
                                            </div>
                                            <small>Example:- (EMPFEHLEN und <span style="color: #f1b300;">Provision</span> erhalten!)</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Second Grey Button Text</label>
                                                        <input name="s_gray_btn_text" type="text" class="form-control" value="">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Second Grey Button Red Text</label>
                                                        <input name="s_g_btn_text_2" type="text" class="form-control" value="">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Second Grey Button Red Text After</label>
                                                        <input name="s_g_btn_text_3" type="text" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <small>Example:- (UNVERBINDLICH BERECHNEN <span style="color: #c90d1e;">ohne Provision</span>)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Modal Description</label>
                                            <textarea type="text" class="form-control summernote" name="modal_description" id="modal_description" rows="4"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group" style="margin-top: 15px;margin-bottom: 0;">
                                            <label>Active</label>
                                        </div>
                                        <div class="form-group" style="margin-top: 0px;">
                                            <label>
                                                <input type="radio" value="1" name="active" id="optionsRadios_2" checked="">
                                                Yes
                                            </label>
                                            <label>
                                                <input type="radio" value="0" name="active" id="optionsRadios_3">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Document</label>
                                        <div id="dZUpload" class="dropzone">
                                            <div class="dz-message needsclick">
                                                <h5>Drop files here or click to upload.</h5>
                                                <a class="btn blue-btn" >select images</a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="images" id="hidden_file_name"/>
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
    <script src="{{admin_assets}}/js/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.colorpicker').colorpicker();

            $('.summernote').summernote({

                minHeight: 100,             // set minimum height of editor
                focus: true
            });

            $( "#optionsRadios_1" ).click(function() {
                $('.optionsRadios').removeClass('show');
                $('.optionsRadios').addClass('hide');
            });
            $( "#optionsRadios_2" ).click(function() {
                $('.optionsRadios').removeClass('hide');
                $('.optionsRadios').addClass('show');
            });


            $( "#category_id" ).change(function() {
                $('#color_code').val($('option:selected', this).attr('data-color'));
            });

        });
    </script>
    <script>

        Dropzone.autoDiscover = false;

        $(document).ready(function () {

            var token_data ='{{ csrf_token() }}';

            var hidden_file_id = [];
            var hidden_file_name = [];
            var file_data_names = [];
            var n = 0;

            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#dZUpload",
            {
                url: "{{ route('admin.documentStore') }}",
                method : "post",
                paramName: "req_images",
                params :{ _token: token_data },
                uploadMultiple: true,
                parallelUploads: 1,
                maxFiles: 30,
                maxFilesize: 9000, // MB
                dictMaxFilesExceeded: "You can only upload up to 10 image File",
                addRemoveLinks: true,
                dictRemoveFile: "Delete",
                acceptedFiles: ".doc, .docx, .xls, .xlsx, .pdf",
                init: function()
                {
                    this.on("success", function (file, response)
                    {

                        var json_obj_file = jQuery.parseJSON(response);

                        for (var i in json_obj_file)
                        {
                            hidden_file_name.push(json_obj_file[i].dfileName);

                            file_data_names[n] = {"serverFileName": json_obj_file[i].dfileName, "fileName": json_obj_file[i].oldFileName, "fileId": n};
                            n++;
                        }

                        //alert(hidden_file_name);
                        //new file names
                        var file_name_string = hidden_file_name.join(",");
                        $('#hidden_file_name').val(file_name_string);

                    });

                    this.on("error", function (file, response)
                    {
                        file.previewElement.classList.add("dz-error");
                                            var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                                            errorDisplay[errorDisplay.length - 1].innerHTML = 'Please Try again. upload file size maximum 5MB';
                    });

                    this.on("removedfile", function(file)
                    {
                        var rmvFile = "";
                        if(file_data_names.length != 0)
                        {
                            for(var f=0; f<file_data_names.length; f++)
                            {
                                if(file_data_names[f].fileName == file.name)
                                {
                                    rmvFile = file_data_names[f].serverFileName;
                                }
                            }
                        }else{
                            rmvFile = file.name;
                        }

                        if (rmvFile)
                        {
                            $('#btn_submit').prop('disabled', true);
                            $(".dz-hidden-input").prop("disabled",false);

                            hidden_file_name = jQuery.grep(hidden_file_name, function( a )
                            {
                                return a !== rmvFile;
                            });

                            var file_name_string = hidden_file_name.join(",");
                            $('#hidden_file_name').val(file_name_string);
                            var $images = $('#hidden_file_name').val();
                            $.post("{{ route('admin.documentRemove') }}",
                            {
                                file: rmvFile, _token:token_data
                            });
                        }

                    });

                }
            });
        });
    </script>
@stop
