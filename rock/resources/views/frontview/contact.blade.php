@extends('frontview.layouts.common')

@section('headerscripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"/>
@stop

@section('content')

<div class="contact_banner" >
    <div class="container" >
        <div class="row" >
            <div class="col-sm-6" >
                <div class="cnt_banner" >
                    <h1>
                        Kontakt<br/>
                        <span class="blue-text" >Tipp</span>geber-Portal
                    </h1>
                    <h3>Für Fragen und Support</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<section >
    <div class="container contact_page">
        <div class="row" >
            <div class="col-md-6" >
                <div class="contact_sec_1" >
                    <h3 class="cmp_name" ><span class="blue-text" >GL</span><span class="logo_second_clr" >V Versicherungsservice</span></h3>
                    <div class="contact_sec_2" >
                        <p>Rathausstraße 13 A<br/>31134 Hildesheim</p>
                    </div>
                    <p class="sec_1_data">Telefon: <span class="blue-text" >+49 (0)51 21 / 98 146 - 0</span> </p>
                    <p class="sec_1_data">E-mail:<span class="blue-text" >&nbsp; &nbsp; info@glv-makler.de</span> </p>
                </div>

                {{--<div class="contact_sec_2" >
                    <p>Rathausstraße 13 A<br/>31134 Hildesheim</p>
                </div>--}}

                <div class="contact_sec_3" >
                    <p class="mb-0 wh_title" >Öffnungszeiten:</p>
                    <p class="mb-0" >Mo.-Do. 08:00 - 17:00 Uhr</p>
                    <p>Fr. &nbsp; &nbsp; 08:00 - 16:00 Uhr <br>und nach Vereinbarung</p>
                </div>
            </div>

            <div class="col-md-6" >
                <div class="contact_sec_4" >
                    <h3 class="blue-text title" >Anfahrt</h3>
                    <p class="blue-text sub_title" >Anfahrtsplan / Routenplaner:</p>
                    <p>Auf dem schnellsten Weg zur unabhängigen Beratung.<br/> Parkplätze findest du ausreichend vor unserem Büro</p><br/>
                    <p>Wir wünschen dir eine angenehme und entspannte Fahrt zu uns</p><br/>

                    <a href="https://www.google.com/maps/place/GLV+Versicherungsservice+GmbH/@52.1520753,9.9544701,20.25z/data=!4m5!3m4!1s0x47baafaa2e5f9fa5:0x264897f8e29c9521!8m2!3d52.1520022!4d9.9544795?hl=de" target="_blank" class="map_btn" >Dein Weg zu uns</a>
                    <p>(externer Link zu Google Maps)</p>

                </div>
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
