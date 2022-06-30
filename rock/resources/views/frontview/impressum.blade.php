@extends('frontview.layouts.common')

@section('headerscripts')
@stop

@section('content')
    <section class="box-bg-color-pd" style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 color-white">
                    @if(isset($pageData['description']) && !empty($pageData['description'])){!! stripslashes($pageData['description']) !!}@endif
                </div>
            </div>
        </div>
    </section>
@stop

@section('footerscripts')
@stop
