@extends('frontview.layouts.common')

@section('headerscripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"/>
@stop

@section('content')
<div class="body_wrap" >
    <div class="container">
        <div class="row">
            <div class="col-md-5">

                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-2-text">
                        {!!$content_data['soeinfach_section_1_text']!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="sec-text-3 text-center sec-text-bg-3 position-relative" style="background:url({{site_data}}/{{$content_data['soeinfach_section_right_image_1']}}); background-size:cover;" >
                    <div class="sec-text-3-1 pb-25 position-relative z-index-2">
                        <h2>{!!$content_data['soeinfach_section_right_title_1']!!}</h2>
                    </div>
                    <div class="sec-text-3-1 second-color position-relative z-index-2">
                        <h2>{!!$content_data['soeinfach_section_right_title_2']!!}</h2>
                    </div>
                </div>
                <div class="images-sec-3">
                    <img src="{{site_data}}/{{$content_data['soeinfach_section_right_image_2']}}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footerscripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    $(".slider").slick({
        dots: true,
    });
    $('.portal-div-section').each(function () {
        $(this).hover(function () {
            $(this).toggleClass("show-image");
        });
    });
</script>
@stop
