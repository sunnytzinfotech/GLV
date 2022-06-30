@extends('admin.layouts.common')
@section('title', 'Home Page Portal')

@section('headerscripts')
@stop

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Deine Page Portal</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{!!url('admin/dashboard')!!}">Dashboard</a>
                </li>
                <li class="active">
                    <strong>Deine Page Portal</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Versicherungsmakler-Option Yes</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
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

                <div class="row">

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>PERSÖNLICHE DATEN</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">PERSÖNLICHE DATEN *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[0]['pdf']) && !empty($result[0]['pdf'])){{ $result[0]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[0]['p_id']) && !empty($result[0]['p_id'])){{ $result[0]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[0]['pdf']) && !empty($result[0]['pdf'])){
                                                    $name = $result[0]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[0]['pdf']) && !empty($result[0]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[0]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>VERTRIEBSVEREINBARUNG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">VERTRIEBSVEREINBARUNG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[1]['pdf']) && !empty($result[1]['pdf'])){{ $result[1]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[1]['p_id']) && !empty($result[1]['p_id'])){{ $result[1]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[1]['pdf']) && !empty($result[1]['pdf'])){
                                                    $name = $result[1]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[1]['pdf']) && !empty($result[1]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[1]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>VERTRAULICHKEITSVERPFLICHTUNG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">VERTRAULICHKEITSVERPFLICHTUNG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[2]['pdf']) && !empty($result[2]['pdf'])){{ $result[2]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[2]['p_id']) && !empty($result[2]['p_id'])){{ $result[2]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[2]['pdf']) && !empty($result[2]['pdf'])){
                                                    $name = $result[2]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[2]['pdf']) && !empty($result[2]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[2]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>AVV VERTRAG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">AVV VERTRAG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[3]['pdf']) && !empty($result[3]['pdf'])){{ $result[3]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[3]['p_id']) && !empty($result[3]['p_id'])){{ $result[3]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[3]['pdf']) && !empty($result[3]['pdf'])){
                                                    $name = $result[3]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[3]['pdf']) && !empty($result[3]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[3]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>DATENSCHUTZINFORMATIONEN</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">DATENSCHUTZINFORMATIONEN *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[4]['pdf']) && !empty($result[4]['pdf'])){{ $result[4]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[4]['p_id']) && !empty($result[4]['p_id'])){{ $result[4]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[4]['pdf']) && !empty($result[4]['pdf'])){
                                                    $name = $result[4]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[4]['pdf']) && !empty($result[4]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[4]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Versicherungsmakler-Option No</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>PERSÖNLICHE DATEN</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">PERSÖNLICHE DATEN *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[5]['pdf']) && !empty($result[5]['pdf'])){{ $result[5]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[5]['p_id']) && !empty($result[5]['p_id'])){{ $result[5]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[5]['pdf']) && !empty($result[5]['pdf'])){
                                                    $name = $result[5]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[5]['pdf']) && !empty($result[5]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[5]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>VERTRIEBSVEREINBARUNG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">VERTRIEBSVEREINBARUNG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[6]['pdf']) && !empty($result[6]['pdf'])){{ $result[6]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[6]['p_id']) && !empty($result[6]['p_id'])){{ $result[6]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[6]['pdf']) && !empty($result[6]['pdf'])){
                                                    $name = $result[6]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[6]['pdf']) && !empty($result[6]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[6]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>VERTRAULICHKEITSVERPFLICHTUNG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">VERTRAULICHKEITSVERPFLICHTUNG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[7]['pdf']) && !empty($result[7]['pdf'])){{ $result[7]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[7]['p_id']) && !empty($result[7]['p_id'])){{ $result[7]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[7]['pdf']) && !empty($result[7]['pdf'])){
                                                    $name = $result[7]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[7]['pdf']) && !empty($result[7]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[7]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>AVV VERTRAG</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">AVV VERTRAG *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[8]['pdf']) && !empty($result[8]['pdf'])){{ $result[8]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[8]['p_id']) && !empty($result[8]['p_id'])){{ $result[8]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[8]['pdf']) && !empty($result[8]['pdf'])){
                                                    $name = $result[8]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[8]['pdf']) && !empty($result[8]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[8]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>DATENSCHUTZINFORMATIONEN</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" action="{{action('admin\DeineController@store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="tz-form-group">
                                                        <label class="control-label">DATENSCHUTZINFORMATIONEN *</label>
                                                        <input type="file" class="form-control" name="pdf_1" value="" accept="application/pdf">
                                                        <input type="hidden" class="form-control" name="pdf_1_old" value="@if(isset($result[9]['pdf']) && !empty($result[9]['pdf'])){{ $result[9]['pdf'] }}@endif">
                                                        <input type="hidden" class="form-control" name="p_id" value="@if(isset($result[9]['p_id']) && !empty($result[9]['p_id'])){{ $result[9]['p_id'] }}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tz-form-group">
                                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                            </div>
                                            @php
                                                $file_path = 'javascript:void(0)';
                                                if(isset($result[9]['pdf']) && !empty($result[9]['pdf'])){
                                                    $name = $result[9]['pdf'];
                                                    $url = URL::asset('uploads');
                                                    $file_path = $url.'/'.$name;
                                                }
                                            @endphp
                                            @if(isset($result[9]['pdf']) && !empty($result[9]['pdf']))
                                                <div style="margin-bottom: 10px;">
                                                    <a href="{{$file_path}}" class="btn btn-small btn-success" download="">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <p style="display: inline-block;margin: 0;">{{$result[9]['pdf']}}</p>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <div class="col-sm-4 col-sm-offset-0" style="padding: 0;">
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                <div class="col-sm-6 pull-right text-right">
                                                    * are required field
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@section('footerscripts')

@stop
