@extends('admin.layouts.common')
@section('title', 'Home Page Content')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Home Page Content</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Home Page Content</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Left Section Description</td>
                                <td>
                                    <?php
                                        if(isset($content_data['home_section_1_text']))
                                        {
                                            $text = strip_tags($content_data['home_section_1_text']);
                                            $str = (strlen($text) > 100) ?substr($text,0,100).'...' :  $text;
                                            echo $str;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_1_text" ui-toggle-class="zoom" ui-target="#home_section_1_text">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>Right Image First</td>
                                <td>
                                    <img src="{{site_data}}@if(isset($content_data['home_section_right_image_1'])){{'/'.$content_data['home_section_right_image_1']}}@endif" class="img-responsive" style="width:100px;">
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_right_image_1" ui-toggle-class="zoom" ui-target="#home_section_right_image_1">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Right Title First</td>
                                <td>@if(isset($content_data['home_section_right_title_1'])) {{$content_data['home_section_right_title_1']}} @endif</td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_right_title_1" ui-toggle-class="zoom" ui-target="#home_section_right_title_1">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Right Title second</td>
                                <td>@if(isset($content_data['home_section_right_title_2'])) {{$content_data['home_section_right_title_2']}} @endif</td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_right_title_2" ui-toggle-class="zoom" ui-target="#home_section_right_title_2">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Right Image Second</td>
                                <td>
                                    <img src="{{site_data}}@if(isset($content_data['home_section_right_image_2'])){{'/'.$content_data['home_section_right_image_2']}}@endif" class="img-responsive" style="width:100px;">
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_right_image_2" ui-toggle-class="zoom" ui-target="#home_section_right_image_2">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------ start contetnt model -------------------->

<div id="home_section_1_text" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Left section description</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Left section description</label>
                            <div class="box m-b-md">
                                <textarea  name="description" class="summernote" >@if(isset($content_data['home_section_1_text'])) {{$content_data['home_section_1_text']}} @endif</textarea>

                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="home_section_1_text">
                                <input type="hidden" name="page_name" value="home">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit_data" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="home_section_right_image_1" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Right Image First</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Right Image First</label>
                            <div class="box m-b-md">
                                <input type="file" name="image" class="form-control" required="">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="home_section_right_image_1">
                                <input type="hidden" name="page_name" value="home">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit_data" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="home_section_right_title_1" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Right Title First</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Right Title First</label>
                            <div class="box m-b-md">
                                <input value="@if(isset($content_data['home_section_right_title_1'])) {{$content_data['home_section_right_title_1']}} @endif" type="text" name="description" class="form-control" required="">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="home_section_right_title_1">
                                <input type="hidden" name="page_name" value="home">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit_data" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="home_section_right_title_2" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Right Title second</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Right Title second</label>
                            <div class="box m-b-md">
                                <input value="@if(isset($content_data['home_section_right_title_2'])) {{$content_data['home_section_right_title_2']}} @endif" type="text" name="description" class="form-control" required="">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="home_section_right_title_2">
                                <input type="hidden" name="page_name" value="home">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit_data" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="home_section_right_image_2" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Right Image second</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Right Image second</label>
                            <div class="box m-b-md">
                                <input type="file" name="image" class="form-control" required="">
                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="home_section_right_image_2">
                                <input type="hidden" name="page_name" value="home">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="submit_data" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!------------------ end contetnt model -------------------->


@stop

@section('footerscripts')
    <script src="{{admin_assets}}/js/plugins/summernote/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({height: 200});

        });
    </script>

@stop
