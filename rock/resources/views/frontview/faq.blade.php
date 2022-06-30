@extends('frontview.layouts.common')

@section('headerscripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"/>
@stop

@section('content')

<section class="faq_page" >
    <div class="container">
        <div class="row">
            <div class="col-md-2" >
                <h1 class="faq_page_title" >FAQs</h1>
            </div>
            <div class="col-md-8">

                <div class="accordion" id="accordionExample">
                    <?php $no = 0 ?>
                    @if(isset($faq_data) && !empty($faq_data))
                    @foreach ($faq_data as $fk => $fv)
                        <div class="card">
                            <div class="card-header">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left accordion-button  @if($fk != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse_{{$fk}}" @if($fk == 0) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse_{{$fk}}">
                                    {{$fv->title}}
                                </button>
                                </h2>
                            </div>

                            <div id="collapse_{{$fk}}" class="collapse @if($fk == 0) show @endif" data-parent="#accordionExample">
                                <div class="card-body">
                                {!! $fv->text !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>

            </div>

            <div class="col-md-2" >
                <img src="{{front_assets}}/images/tipps-img-2.png" class="img-fluid">
            </div>

        </div>
    </div>
</section>



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
