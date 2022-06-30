@extends('frontview.layouts.common')

@section('headerscripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"/>
@stop

@section('content')

    <section class="box-bg-color-pd" id="section-one">
        <div class="">
            <div class="position-relative">
                <div class="slider">
                @if(isset($home_slider) && !empty($home_slider))
                    @foreach ($home_slider as $Skey => $s_value)
                        <div class="heading-text-section-1 ">
                            <div class="position-relative z-index-5 container">
                            <h1>@if(isset($s_value['text_1']) && !empty($s_value['text_1'])){!! $s_value['text_1'] !!}@endif</h1>
                            <h4>@if(isset($s_value['text_2']) && !empty($s_value['text_2'])){!! $s_value['text_2'] !!}@endif</h4></div>
                            <div class="slider-bd"></div>
                            <div class="slider-image " style="background-image:url('{{URL::asset('uploads')}}/{!!App\CustomFunction\CustomFunction::decode_input($s_value['image'])!!}')"></div>
                        </div>
                    @endforeach
                @endif
                </div>
                <div class="postal-image-slider-img">
                    <img src="{{front_assets}}/images/slider-img.png" class="img-fluid tips_sec">
                </div>
            </div>
        </div>
        <div class="container portal-category position-relative">
            <div class="row nav nav-tabs" id="myTab" role="tablist">
                @if(isset($portal_category) && !empty($portal_category))
                    @foreach ($portal_category as $Ckey => $c_value)
                        <div class="col-sm-4">
                            <div class="nav-item portal-div-section">
                                @php
                                    $portal_image =  URL::asset('uploads').'/'.$c_value['c_image'];
                                    $portal_color =  $c_value['color'];
                                @endphp
                                <style>
                                    .show-image .portal_image-{{$Ckey}}::before{
                                         content:'';
                                         position: absolute;
                                         height: 100%;
                                         width: 100%;
                                         left:0;
                                         top:0;
                                         background:{{$portal_color}};
                                         background-position: center;
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                         z-index:10;
                                         opacity: 0.5;
                                     }
                                     .show.active.portal_image-{{$Ckey}}::before{
                                         content:'';
                                         position: absolute;
                                         height: 100%;
                                         width: 100%;
                                         left:0;
                                         top:0;
                                         background:{{$portal_color}};
                                         background-position: center;
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                         z-index:10;
                                         opacity: 0.5;
                                    }
                                    .show-image .portal_image-{{$Ckey}}::after{
                                         content:'';
                                         position: absolute;
                                         height: 100%;
                                         width: 100%;
                                         left:0;
                                         top:0;
                                         background-image:url({{$portal_image}});
                                         background-position: center;
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                     }
                                     .show.active.portal_image-{{$Ckey}}::after{
                                         content:'';
                                         position: absolute;
                                         height: 100%;
                                         width: 100%;
                                         left:0;
                                         top:0;
                                         background-image:url({{$portal_image}});
                                         background-position: center;
                                         background-size: cover;
                                         background-repeat: no-repeat;
                                    }
                                </style>
                                <a class="nav-link portal-cat-btn portal_image-{{$Ckey}}" id="portal-tab-{{$c_value['c_id']}}" data-toggle="tab" href="#portal-{{$c_value['c_id']}}" role="tab" aria-controls="portal_tab_{{$c_value['c_id']}}" aria-selected="true">
                                    <div class="category-title">
                                    @if(isset($c_value['c_name']) && !empty($c_value['c_name'])){!! $c_value['c_name'] !!}@endif
                                    </div>
                                    <div class="category-btn">
                                    mehr >
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row" id="tips" >
                <div class="col-md-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane masonry-container fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="grid-title">
                                <div class="portal-title-category">
                                    <div class="portal-title-image">
                                        <img src="{{front_assets}}/images/tipps-img.png" class="img-fluid">
                                    </div>
                                    SPECIAL TIPPS
                                </div>
                            </div>
                            <div class="masonary_gallary">
                                @if(isset($result) && !empty($result))
                                    @foreach ($result as $key => $value)
                                        <figure>
                                            @php
                                                $user_data = Auth::user();

                                                $chack_modal_open = 0;

                                                if(isset($user_data) && !empty($user_data)){
                                                    if ($user_data->admin_confirm != 0 && $user_data->email_confirm != 0) {
                                                        $chack_modal_open = 1;
                                                    }
                                                }
                                            @endphp
                                            <div class="bg-white cursor-pointer"
                                            @if(isset($user_data))
                                                @if($user_data->email_confirm != 0)
                                                    @if($value['model'] == 1 && $user_data->admin_confirm == 1)
                                                        data-toggle="modal" data-target="#masonry_model_{{$value['id']}}" data-popupid="{{$value['id']}}"
                                                    @endif
                                                    @if($value['model'] == 1 && $user_data->admin_confirm == 0)
                                                        data-toggle="modal" data-target="#masonry_denie"
                                                    @endif
                                                @endif
                                            @else
                                                data-toggle="modal" data-target="#myModal"
                                            @endif
                                            >
                                                <div class="home-logo-masonry"><img src="{{URL::asset('uploads/modelLogo')}}/{!!App\CustomFunction\CustomFunction::decode_input($value['logo'])!!}" class="img-fluid"></div>
                                                <div class="home-text-masonry">
                                                    <div><h3>@if(isset($value['title']) && !empty($value['title'])){!! $value['title'] !!}  @endif</h3></div>
                                                    <div><p>@if(isset($value['decription']) && !empty($value['decription'])){!! $value['decription'] !!}  @endif</p></div>
                                                    <div class="home-masonry-price">@if(isset($value['price']) && !empty($value['price'])){!! stripslashes($value['price']) !!}@endif <br>@if(isset($value['price']) && !empty($value['price']))<span>{!! $value['sub_price'] !!}</span>@endif</div>
                                                </div>
                                                <div class="pdf_sec_outter" >
                                                    @if(isset($value['document']) && !empty($value['document']))
                                                        <?php $pdfs = json_decode($value['document'],true); ?>
                                                        @foreach($pdfs as $pdf)
                                                            <div class="pdf_sec">
                                                                <img src="{{front_assets}}/images/pdf.png" class="img-fluid">
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="masonry-footer" style="background: @if(isset($value['color']) && !empty($value['color'])){!! $value['color'] !!}  @endif;"></div>
                                            </div>
                                        </figure>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if(isset($portal_category) && !empty($portal_category))
                            @foreach ($portal_category as $Dkey => $d_value)
                                <div class="tab-pane masonry-container fade" id="portal-{{$d_value['c_id']}}" role="tabpanel" aria-labelledby="portal-tab-{{$d_value['c_id']}}">
                                    <div class="grid-title">
                                        <div class="portal-title-category">
                                        <div class="portal-title-image">
                                            <img src="{{front_assets}}/images/tipps-img.png" class="img-fluid">
                                        </div>
                                            @if(isset($d_value['c_name']) && !empty($d_value['c_name'])){!! $d_value['c_name'] !!}@endif
                                        </div>
                                    </div>
                                    @php
                                        $portal_data = App\Models\HomePortal::where('category_id','=',$d_value['c_id'])->where('active','=',1)->get()->toArray();
                                    @endphp
                                    <div class="masonary_gallary">
                                        @if(isset($portal_data) && !empty($portal_data))
                                            @foreach ($portal_data as $Pkey => $p_value)
                                                <figure>
                                                    @php
                                                        $user_data = Auth::user();

                                                        $chack_modal_open = 0;

                                                        if(isset($user_data) && !empty($user_data)){
                                                            if ($user_data->admin_confirm != 0 && $user_data->email_confirm != 0) {
                                                                $chack_modal_open = 1;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="bg-white cursor-pointer "
                                                    @if(isset($user_data))
                                                        @if($user_data->email_confirm != 0)
                                                            @if($p_value['model'] == 1 && $user_data->admin_confirm == 1)
                                                                data-toggle="modal" data-target="#masonry_model_{{$p_value['id']}}" data-popupid="{{$p_value['id']}}"
                                                            @endif
                                                            @if($p_value['model'] == 1 && $user_data->admin_confirm == 0)
                                                                data-toggle="modal" data-target="#masonry_denie"
                                                            @endif
                                                        @endif
                                                    @else
                                                        data-toggle="modal" data-target="#myModal"
                                                    @endif>
                                                        <div class="home-logo-masonry"><img src="{{URL::asset('uploads/modelLogo')}}/{!!App\CustomFunction\CustomFunction::decode_input($p_value['logo'])!!}" class="img-fluid"></div>
                                                        <div class="home-text-masonry">
                                                            <div><h3>@if(isset($p_value['title']) && !empty($p_value['title'])){!! $p_value['title'] !!}  @endif</h3></div>
                                                            <div><p>@if(isset($p_value['decription']) && !empty($p_value['decription'])){!! $p_value['decription'] !!}  @endif</p></div>
                                                            <div class="home-masonry-price">@if(isset($p_value['price']) && !empty($p_value['price'])){!! stripslashes($p_value['price']) !!}@endif <br>@if(isset($p_value['price']) && !empty($p_value['price']))<span>{!! $p_value['sub_price'] !!}</span>@endif</div>
                                                        </div>
                                                        <div class="pdf_sec_outter" >
                                                            @if(isset($p_value['document']) && !empty($p_value['document']))
                                                                <?php $pdfs = json_decode($p_value['document'],true); ?>
                                                                @foreach($pdfs as $pdf)
                                                                    <div class="pdf_sec" >
                                                                        <img src="{{front_assets}}/images/pdf1.png" class="img-fluid" >
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="masonry-footer" style="background: @if(isset($p_value['color']) && !empty($p_value['color'])){!! $p_value['color'] !!}  @endif;"></div>
                                                    </div>
                                                </figure>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- <div class="tm-next tm-intro-next">
                <a href="javascript:void(0)" class="text-center tm-down-arrow-link into_sec"> <i class="fa fa-angle-down"></i></a>
            </div> -->
            <div class="postal-image-test">
            <img src="{{front_assets}}/images/tipps-img-2.png" class="img-fluid">
            </div>
        </div>

    </section>

    @if(empty($user_data ))
        <section class="sec-bg" id="introduction">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="sec-2-text home_text_1">
                        {!!$siteData['home_section_1_text']!!}
                    </div>
                    <div class="sec-2-btn" id="introduction_2">
                        <a href="javascript:voide(0);" class="btn-sec-1 home_meh_1">mehr...</a>
                        <a href="javascript:voide(0);" class="btn-sec-1 home_wen_1">weniger</a>
                    </div>
                    <div class="sec-2-text home_text_2">
                        {!!$siteData['home_section_2_text']!!}
                    </div>
                    <div class="sec-2-btn">
                        <a href="javascript:voide(0);" class="btn-sec-1 home_meh_2">mehr...</a>
                        <a href="javascript:voide(0);" class="btn-sec-1 home_wen_2">weniger</a>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <div class="position-relative">
                        <img src="{{site_data}}/{{$siteData['home_section_right_image_1']}}" class="img-fluid" >
                        <h2 class="text_on_img" >{!!$siteData['home_section_right_title_1']!!}</h2>
                    </div>
                    {{-- <div class="sec-text-3 text-center sec-text-bg-3 position-relative" style="background:url({{site_data}}/{{$siteData['home_section_right_image_1']}}); background-size:cover;" >
                        <div class="sec-text-3-1 pb-25 position-relative z-index-2">
                            <h2>{!!$siteData['home_section_right_title_1']!!}</h2>
                        </div>
                    </div> --}}
                    <div class="images-sec-3">
                        <img src="{{site_data}}/{{$siteData['home_section_right_image_2']}}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(empty($user_data ))
        <section class="sec-3-btn">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                        $register = "RegisterModal";
                        if (isset($user_data) && !empty($user_data)) {
                            if ($user_data->admin_confirm != 0) {
                                $register = "RegisterModal1";
                            }
                            $register = "RegisterModal1";
                        }
                        ?>
                        <a href="javascript:void(0);" class="btn-sec-3" data-toggle="modal" data-target="#{{$register}}">HIER GLEICH REGISTRIEREN</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(isset($result_1) && !empty($result_1))
        @foreach ($result_1 as $m_key => $m_value)
        <!-- Model Register -->
        <div class="modal fade registration-modal bd-example-modal-lg" id="masonry_model_{{$m_value['id']}}" tabindex="-1" role="dialog"
             aria-labelledby="masonry_model" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
                <div class="modal-content rounded-0 pb-3">
                    <!-- header -->
                    <div class="modal-header masonry-header">
                        <div class="row d-flex justify-content-between">
                            <!-- image -->
                            <div class="col-md-7 col-lg-7 text-center pr-0">
                                <div class="d-flex align-items-center w-100 h-100 justify-content-center" >
                                <img src="{{URL::asset('uploads/modelLogo')}}/{!!App\CustomFunction\CustomFunction::decode_input($m_value['logo'])!!}" class="img-fluid masonry-modal-logo" alt="">
                                </div>
                            </div>
                            <!-- image Overt-->
                            <!-- heading -->
                            <div class="col-md-5 col-lg-5 pl-0">

                                @php
                                    $beoker_check = "no";
                                    if(isset($user_data->broker) && !empty($user_data->broker)){
                                        if($user_data->broker == 'yes'){
                                            $beoker_check = "yes";
                                        }
                                    }
                                    // echo $beoker_check;
                                @endphp

                                @if($beoker_check == 'yes')
                                    <div class="modal-btn-1">
                                        <a class="popup-id" href="javascript:;" data-toggle="modal" data-target="#sendMessage" data-dismiss="modal" data-popupid="{{$m_value['id']}}">
                                            <h6>@if(isset($m_value['b_btn_text']) && !empty($m_value['b_btn_text'])){!! stripslashes($m_value['b_btn_text']) !!}@endif <span class="yellow"> @if(isset($m_value['b_btn_text_2']) && !empty($m_value['b_btn_text_2'])){!! stripslashes($m_value['b_btn_text_2']) !!}@endif</span> @if(isset($m_value['b_btn_text_3']) && !empty($m_value['b_btn_text_3'])){!! stripslashes($m_value['b_btn_text_3']) !!}@endif</h6>
                                        </a>
                                    </div>
                                    <div class="modal-btn-2">
                                        @if($m_value['check_internal_frame'] == '1' )
                                            <a href="{!!url('open-iframe')!!}/{!!$m_value['id']!!}" class="Iframe">
                                                <h6>@if(isset($m_value['g_btn_text']) && !empty($m_value['g_btn_text'])){!! stripslashes($m_value['g_btn_text']) !!}@endif <span class="red"> @if(isset($m_value['g_btn_text_2']) && !empty($m_value['g_btn_text_2'])){!! stripslashes($m_value['g_btn_text_2']) !!} @endif </span> @if(isset($m_value['g_btn_text_3']) && !empty($m_value['g_btn_text_3'])){!! stripslashes($m_value['g_btn_text_3']) !!}@endif</h6>
                                            </a>
                                        @else
                                            <a href="@if(isset($m_value['g_btn_url']) && !empty($m_value['g_btn_url'])){!! stripslashes($m_value['g_btn_url']) !!}@endif" target="_blank" class="internal">
                                                <h6>@if(isset($m_value['g_btn_text']) && !empty($m_value['g_btn_text'])){!! stripslashes($m_value['g_btn_text']) !!}@endif <span class="red"> @if(isset($m_value['g_btn_text_2']) && !empty($m_value['g_btn_text_2'])){!! stripslashes($m_value['g_btn_text_2']) !!} @endif </span> @if(isset($m_value['g_btn_text_3']) && !empty($m_value['g_btn_text_3'])){!! stripslashes($m_value['g_btn_text_3']) !!}@endif</h6>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="modal-btn-1">
                                        <a class="popup-id" href="javascript:;" data-toggle="modal" data-target="#sendMessage" data-dismiss="modal" data-popupid="{{$m_value['id']}}">
                                            <h6>@if(isset($m_value['s_b_btn_text']) && !empty($m_value['s_b_btn_text'])){!! stripslashes($m_value['s_b_btn_text']) !!}@endif <span class="yellow"> @if(isset($m_value['s_b_btn_text_2']) && !empty($m_value['s_b_btn_text_2'])){!! stripslashes($m_value['s_b_btn_text_2']) !!}@endif</span> @if(isset($m_value['s_b_btn_text_3']) && !empty($m_value['s_b_btn_text_3'])){!! stripslashes($m_value['s_b_btn_text_3']) !!}@endif</h6>
                                        </a>
                                    </div>
                                    <div class="modal-btn-2">
                                        @if($m_value['check_internal_frame'] == '1' )
                                            <a class="secondpopup-id" href="#second_btn" class="Iframe" data-dismiss="modal" data-target="#second_btn" data-secondpopupid="{{$m_value['id']}}" data-toggle="modal">
                                                <h6>@if(isset($m_value['s_g_btn_text']) && !empty($m_value['s_g_btn_text'])){!! stripslashes($m_value['s_g_btn_text']) !!}@endif <span class="red"> @if(isset($m_value['s_g_btn_text_2']) && !empty($m_value['s_g_btn_text_2'])){!! stripslashes($m_value['s_g_btn_text_2']) !!} @endif </span> @if(isset($m_value['s_g_btn_text_3']) && !empty($m_value['s_g_btn_text_3'])){!! stripslashes($m_value['s_g_btn_text_3']) !!}@endif</h6>
                                            </a>
                                        @else
                                            <a href="@if(isset($m_value['g_btn_url']) && !empty($m_value['g_btn_url'])){!! stripslashes($m_value['g_btn_url']) !!}@endif" target="_blank" class="internal">
                                                <h6>@if(isset($m_value['s_g_btn_text']) && !empty($m_value['s_g_btn_text'])){!! stripslashes($m_value['s_g_btn_text']) !!}@endif <span class="red"> @if(isset($m_value['s_g_btn_text_2']) && !empty($m_value['s_g_btn_text_2'])){!! stripslashes($m_value['s_g_btn_text_2']) !!} @endif </span> @if(isset($m_value['s_g_btn_text_3']) && !empty($m_value['g_btn_text_3'])){!! stripslashes($m_value['s_g_btn_text_3']) !!}@endif</h6>
                                            </a>
                                        @endif
                                    </div>
                                @endif


                            </div>
                            <!-- heading Over-->
                        </div>
                    </div>
                    <!-- header Over-->

                    <!-- content -->
                    <div class="modal-body p-0">
                        <div class="registration-modal-content">

                            <h2 class="model-title">@if(isset($m_value['title']) && !empty($m_value['title'])){!! $m_value['title'] !!}@endif</h2>
                            <div class="model-decription">
                                @if(isset($m_value['m_description']) && !empty($m_value['m_description'])){!! $m_value['m_description'] !!}@endif
                            </div>
                        </div>
                    </div>
                    <!-- content Over-->
                    <div class="modal-footer border-0">
                        <small class="blue-text">schließen</small>
                        <button type="button" class="modal-close-button shadow" data-dismiss="modal">
                            X
                        </button>
                    </div>

                    @if(isset($m_value['document']) && !empty($m_value['document']))
                    <div class="model_pdfs" >
                        <div class="title" >
                            Stand {{ date('m Y',strtotime($m_value['updated_at'])) }}
                        </div>
                        <div class="model_pdf_sec_outter" >
                            <?php $pdfs = json_decode($m_value['document'],true); ?>
                            @foreach($pdfs as $pdf)
                                <div class="model_pdf_sec" >
                                    <a href="{{file_folder}}/document/{{$pdf}}" target="_blank" ><img src="{{front_assets}}/images/pdf1.png" class="img-fluid" ></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Model Register Over -->
        @endforeach
    @endif

<!-- Model Message Send -->
<div class="modal fade registration-modal bd-example-modal-lg" id="second_btn" tabindex="-1" role="dialog"
     aria-labelledby="RegisterModal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal_cus_reg" role="document">
        <div class="modal-content rounded-0 pb-3">
            <!-- header -->
            <!-- header Over-->

            <!-- content -->
            <div class="modal-body  pl-80 pr-80">
                <div class="registration-modal-content">
                    <div class="row d-flex justify-content-between">
                        <!-- heading -->
                        <div class="col-md-8 col-lg-8">
                            <h3 class="blue-second-form" style="font-size:23px;">Für die Zuordnung des Interessenten/<br>Kunden benötigen wir noch dessen Vor-und Nachnamen</h3>
                        </div>
                        <!-- heading Over-->

                        <!-- image -->
                        <div class="col-md-4 col-lg-4 text-right">
                            <img src="{{front_assets}}/images/register-page-image.png" class="img-fluid reg-modal-image"
                                 alt="">
                        </div>
                        <!-- image Overt-->
                    </div>

                    <!-- form -->
                    <form id="second-form" action="{{action('Frontend\IndexController@secondAddData')}}" method="post" autocomplete="off">
                    @csrf
                        <!-- check box -->
                        <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                            <div class="col-md-12 col-lg-6 ">
                            <input type="hidden" name="user_id" value="@if(isset($auth->id)&&!empty($auth->id)){{$auth->id}}@endif">
                                <input type="hidden" value="" name="popup_id" id="secondpopup_id">
                                <ul class="list-unstyled list-inline mt-3">
                                <label>Interessent/in:</label>
                                    <li class="list-inline-item">
                                        <div class="d-flex align-items-center">
                                            <label for="Frau">Frau</label>
                                            <input type="radio" name="frau" id="Frau" class="check-box-css mt-0" value="frau" checked value="frau"/>
                                        </div>
                                    </li>

                                    <li class="list-inline-item ml-9">
                                        <div class="d-flex align-items-center">
                                            <label for="Herr">Herr</label>
                                            <input type="radio" name="frau" id="Herr" class="check-box-css mt-0" value="herr"/>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- check box Over-->
                        <!-- names -->
                        <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                            <div class="col-md-12 col-lg-6 ">
                                <label>Nachname<span class="blue-text">*</span></label><br>
                                <input type="text" required name="nachname">
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label>Vorname<span class="blue-text">*</span></label><br>
                                <input type="text" required name="vorname">
                            </div>
                        </div>
                        <!-- names Over-->

                        <div class="form-check mt-3">
                            <input type="checkbox" class="check-box-css check-box-css-terms form-check-input"
                                   id="terms1" required name="terms">
                            <p class="terms-text">
                                Hiermit bestätige ich (Tippgeber),dass ich das Einverständnis der Interessentin/ des Interessenten habe,seine<br>
                                Daten ausschließlich zum Zweck dieser Tippgebung an die <b>GLV Versicherungsservice GmbH</b> weitergeben zu dürfen.
                            </p>
                        </div>

                        {{--<div class="col-md-12 input-number-text">
                            <div class="row mx-auto" style="align-items: baseline;">
                                <p>Zeigen Sie, dass Sie kein Bot sind: </p>
                                <input type="number" name="confirm_no" id="confirm_no"><br>
                                @php
                                    $rang = rand(1,50);
                                    $rang1 = rand(51,100);
                                @endphp
                                <p class="ml-2">+ {!! $rang !!} = {!! $rang1 !!}</p>
                                <input type="hidden" name="number1" value="{!! $rang !!}" id="number1">
                                <input type="hidden" name="total" value="{!! $rang1 !!}" id="total">

                            </div>
                        </div>--}}

                        <div class="row mx-auto d-flex justify-content-between input-number-text align-items-center mt-5">
                            <div class="col-md-7">
                                <p class="font-italic text-muted mt-0"><span class="blue-text">*</span>Pflichtfelder</p>
                            </div>
                            <div class="col-md-5 text-right pr-0">
                                <button class="next-btn" type="submit" value="submit" name="submit">SENDEN</button>
                            </div>
                        </div>

                        <div class="form__success">
                            <p id="message_display"></p>
                        </div>
                    </form>

                    <!-- form Over-->
                </div>
            </div>
            <!-- content Over-->
            <div class="modal-footer border-0  pl-80 pr-80">
                <small class="blue-text">schließen</small>
                <button type="button" class="modal-close-button shadow" data-dismiss="modal">
                    X
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Model Message Send -->
@stop

@section('footerscripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
    $(function () {

    $("#second-form").validate({
        rules: {
                nachname: {
                    required: true,
                },
                vorname: {
                    required: true,
                },
                confirm_no: {
                    required: false,
                    remote: {
                        url: "{{URL::to('secondvarifytotal')}}",
                        type: "POST",
                        data: {
                            confirm_no: function () {
                                return $("#confirm_no").val();
                            },
                            number1: function () {
                                return $("#number1").val();
                            },
                            total: function () {
                                return $("#total").val();
                            },
                            _token: "{{ csrf_token() }}",
                        }
                    }
                },
            },
            messages: {
                nachname: {
                    required: "Bitte Nachnamen eingeben!"
                },
                vorname: {
                    required: "Bitte Vornamen eingeben!"
                },
                confirm_no: {
                    required: "Bitte den richtigen Wert eingeben!",
                    remote: "Bitte den richtigen Wert eingeben!"
                },
            }
    });
});
</script>
    <script>
        $( document ).ready(function() {
            $(".slider").slick({
                dots: true,
            });
            $('.portal-div-section').each(function () {
                $(this).hover(function () {
                    $(this).toggleClass("show-image");
                });
            });
            $('.portal-div-section .portal-cat-btn').click(function () {
                $('.portal-div-section .portal-cat-btn').removeClass('active');
                $('.portal-div-section .portal-cat-btn').removeClass('show');
                $(this).addClass('active');
                $(this).addClass('show');

                var ele_id = $(this).attr('href');
                console.log(ele_id);
                $('.tab-pane').removeClass('show');
                $('.tab-pane').removeClass('active');
                $(ele_id).addClass('active');
                $(ele_id).addClass('show');
            });

            $('.home_meh_1').click(function(){
                $('.home_text_1').css({'height':'auto'});
                $(this).hide();
                $('.home_wen_1').show();
            });
            $('.home_meh_2').click(function(){
                $('.home_text_2').css({'height':'auto'});
                $(this).hide();
                $('.home_wen_2').show();
            });

            $('.home_wen_1').click(function(){
                $('.home_text_1').css({'height':'274px'});
                $(this).hide();
                $('.home_meh_1').show();
            });
            $('.home_wen_2').click(function(){
                $('.home_text_2').css({'height':'274px'});
                $(this).hide();
                $('.home_meh_2').show();
            });

        });
    </script>
    <script>
        $(document).ready(function(){
        $(window).scroll(function() { // check if scroll event happened
            if ($(document).scrollTop() > 50){ // check if user scrolled more than 50 from top of the browser window

            $(".header").addClass("sticky"); // if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
            } else {
                $(".header").removeClass("sticky");
            // $(".header").secondClass("background", "whitesmoke"); // if not, change it back to transparent
            }
        });
        });
    </script>
    <script>
        $(document).ready(function(){
        $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
    });
    </script>


<script>
    $( ".secondpopup-id" ).each(function(index) {
        $(this).on("click", function(){
            var secondpopupid = $(this).data('secondpopupid');
            $('#secondpopup_id').val(secondpopupid);
        });
    });

</script>

@stop
