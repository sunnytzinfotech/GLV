@extends('admin.layouts.common')
@section('title', 'Page Content')

@section('headerscripts')
    <link href="{{admin_assets}}/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
@stop
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Page Content</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Page Content</strong>
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
                            <th>Page</th>
                            <th>Description</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Impressum</td>
                                <td>
                                    <?php
                                        if(isset($content_data['impressum']))
                                        {
                                            $text = strip_tags($content_data['impressum']);
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
                                <td>Datenschutz</td>
                                <td>
                                    <?php
                                        if(isset($content_data['datenschutz']))
                                        {
                                            $text = strip_tags($content_data['datenschutz']);
                                            $str = (strlen($text) > 100) ?substr($text,0,100).'...' :  $text;
                                            echo $str;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_2_text" ui-toggle-class="zoom" ui-target="#home_section_2_text">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Erstinformation</td>
                                <td>
                                    <?php
                                        if(isset($content_data['erstinformation']))
                                        {
                                            $text = strip_tags($content_data['erstinformation']);
                                            $str = (strlen($text) > 100) ?substr($text,0,100).'...' :  $text;
                                            echo $str;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-info" data-toggle="modal" data-target="#home_section_3_text" ui-toggle-class="zoom" ui-target="#home_section_2_text">
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
                    <h5 class="modal-title">Left section description First</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Left section description First</label>
                            <div class="box m-b-md">
                                <textarea  name="description" class="summernote" >@if(isset($content_data['impressum'])) {{$content_data['impressum']}} @endif</textarea>

                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="impressum">
                                <input type="hidden" name="page_name" value="page_data">
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

<div id="home_section_2_text" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Left section description Second</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Left section description Second</label>
                            <div class="box m-b-md">
                                <textarea  name="description" class="summernote" required>@if(isset($content_data['datenschutz'])) {{$content_data['datenschutz']}} @endif</textarea>

                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="datenschutz">
                                <input type="hidden" name="page_name" value="page_data">
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

<div id="home_section_3_text" class="modal fade animate in" data-backdrop="true" style="display: none;">
    <div class="modal-dialog modal-lg" ui-class="zoom">
        <div class="modal-content">
            <form action="{{action('admin\SaveDataController@datasubmit')}}" class="content_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Left section description Second</h5>
                </div>
                <div class="modal-body p-lg">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Left section description Second</label>
                            <div class="box m-b-md">
                                <textarea  name="description" class="summernote" required>@if(isset($content_data['erstinformation'])) {{$content_data['erstinformation']}} @endif</textarea>

                                <input name="_token" type="hidden" value="{{csrf_token()}}" />
                                <input type="hidden" name="action" value="erstinformation">
                                <input type="hidden" name="page_name" value="page_data">
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
