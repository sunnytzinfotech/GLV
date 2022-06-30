@extends('frontview.layouts.common')

@section('headerscripts')
@stop

@section('content')

    <div class="registration-modal pb-5 pt-10 bg-black ">
        <div class="container">
            <div class="row bg-wight">
                <!-- heading -->
                <div class="col-md-11 col-lg-8 mx-auto">
                    <!-- heading image-->
                    <div class="row d-flex justify-content-between pt-5">
                        <div class="col-md-12 col-lg-12 mx-auto pt-4">

                        </div>
                        {{-- <div class="col-md-4 col-lg-4 register-page-header-image">
                            <img src="{{front_assets}}/images/register-page-image.png" class="img-fluid" alt="">
                        </div> --}}
                    </div>
                    <!-- heading image Over-->
                    <h3 class="blue-text mb-3">DEINE UNTERLAGEN</h3>
                    <p class="mb-2 " >Hier ﬁndest du deine hochgeladenen Vertragsunterlagen als PDF-Uploads.</p>
                    <h4 class="mt-0 mb-2" >Bitte überprüfe die Dokumente noch einmal auf ihre Richtigkeit! Sofern Deine Angaben alle korrekt sein sollten, gehe auf BESTÄTIGEN. Somit wird der Partnervertrag rechtsgültig.</h4>
                    <p class="mb-2">
                        Solltest du Unstimmigkeiten in deinen Verträgen ﬁnden oder sollte dir etwas unklar sein, so nimm am besten Kontakt zu uns auf: <a href="mailto:info@glv-makler.de" class="blue-text open-sans-bold font-italic">info@glv-tipp.de</a> oder <a href="tel:+49(0)5121" class="blue-text open-sans-bold">anrufen</a>.
                    </p>
                    <p>
                        Sobald uns alles vorliegt, wird deine Registrierung überprüft und – sofern alles passt – in der Regel bestätigt. Anschließend kannst du alle Vorteile unseres Portals nutzen.
                    </p>
                </div>
                <!-- blue section -->
                <div class="col-md-11 col-lg-9 mx-auto blue-section">
                    <div class="blue-section-text-wrp">
                        <p class="open-sans-bold text-uppercase text-white">HINWEIS: </p>
                        <p class="open-sans-bold text-white">
                            Alle unten aufgelisteten Dokumente sind bei Online-Abschluss OHNE Unterschrift gültig!
                            Die BESTÄTIGUNG der Dokumente ist ein rechstgültiger Vertragsabschluss.
                        </p>
                    </div>
                </div>
                <!-- blue section Over-->

                <!-- register list dsection -->
                <div class="col-md-11 col-lg-9 mx-auto register-list-section mx-auto">
                    <?php
                        $value = Auth::user();
                        $register = "RegisterModal";
                        if (isset($value) && !empty($value)) {
                            if ($value->admin_confirm != 0) {
                                $register = "RegisterModal1";
                            }
                            $register = "RegisterModal1";
                        }
                        $id = $value->id;
                        $value_user = App\Models\UserDetail::where('user_id', $id)->first();
                        $check = "check-image";
                    ?>
                    <!-- 1 -->
                    @php
                        $check_status = 0 ;
                        if (isset($value_user->check_status) && !empty($value_user->check_status)){
                            if ($value_user->check_status == 1){
                                $check_status = 1 ;
                            }
                        }

                        if($broker == 'yes'){
                            if(isset($result[0]['p_id']) && !empty($result[0]['p_id'])){
                                $file_1 = $result[0]['p_id'];
                            }
                        }else{
                            if(isset($result[5]['p_id']) && !empty($result[5]['p_id'])){
                                $file_1 = $result[5]['p_id'];
                            }
                        }
                    @endphp
                    <div class="row d-flex justify-content-between align-items-center register-list-section-wrp" id="first">
                        <!-- number -->

                        <div class="col-md-1">
                            <div class="number  @if($check_status == 1) check-number @endif ">1</div>
                        </div>
                        <!-- number Over-->
                        <!-- title -->
                        <div class="col-md-8">
                            <p class="main-title">PERSÖNLICHE DATEN </p>
                            <p class="sub-title"><a href="{!!url('distribution_download') !!}/{{ $file_1 }}">(PDF Download)</a></p>
                        </div>
                        <!-- title Over-->
                        <!-- button -->
                        <div class="col-md-2 button-wrp">
                            <button class="button-1 @if($check_status == 1) active @endif" data-toggle="modal" data-target="#{{$register}}">liegt vor</button>
                        </div>
                        <!-- button Over-->

                        <!-- hover image -->

                        <div class="col-md-1 image-sec">
                            <div class="hover-image text-center @if($check_status == 1) check-image @endif"></div>
                        </div>
                        <!-- hover image Over-->
                    </div>
                    <!-- 1 Over-->

                    <!-- 2 -->
                    @php
                        $distribution_status = 0 ;
                        if (isset($value_user->distribution_status) && !empty($value_user->distribution_status)){
                            if ($value_user->distribution_status == 1){
                                $distribution_status = 1 ;
                            }
                        }

                        $file_2 = null;
                        if($broker == 'yes'){
                            if(isset($result[1]['p_id']) && !empty($result[1]['p_id'])){
                                $file_2 = $result[1]['p_id'];
                            }
                        }else{
                            if(isset($result[6]['p_id']) && !empty($result[6]['p_id'])){
                                $file_2 = $result[6]['p_id'];
                            }
                        }
                    @endphp
                    <div class="row d-flex justify-content-between align-items-center register-list-section-wrp" id="second">
                        <!-- number -->
                        <div class="col-md-1">
                            <div class="number @if($check_status == 1) @if($distribution_status == 1) check-number @endif @endif">2</div>
                        </div>
                        <!-- number Over-->
                        <!-- title -->
                        <div class="col-md-8">
                            <p class="main-title">VERTRIEBSVEREINBARUNG </p>
                            <p class="sub-title"><a href="{!!url('distribution_download') !!}/{{ $file_2 }}">(PDF Download)</a></p>
                        </div>
                        <!-- title Over-->
                        <!-- button -->
                        <div class="col-md-2 button-wrp">
                        @if($check_status == 1)
                            <form method="POST" enctype="multipart/form-data" id="distribution-store-file" action="javascript:void(0)">
                                <label class="book-2-upload-button button-1 @if($distribution_status == 1) active @endif">
                                    @if($distribution_status == 1)
                                    <input type="file" accept="application/pdf" name="distribution" id="pass_image_1"> liegt vor
                                    @else
                                    <input type="file" accept="application/pdf" name="distribution" id="pass_image_1"> ÖFFNEN
                                    @endif
                                </label>
                            </form>
                        @else
                            <label class="book-2-upload-button button-1">
                                ÖFFNEN
                            </label>
                        @endif
                        </div>
                        <!-- button Over-->

                        <!-- hover image -->
                        <div class="col-md-1 image-sec">

                            <div class="hover-image text-center @if($check_status == 1) @if($distribution_status == 1) check-image @endif @endif"></div>
                        </div>
                        <!-- hover image Over-->
                    </div>
                    <!-- 2 Over-->

                    <!-- 3 -->
                    @php
                        $confidentiality_status = 0 ;
                        if (isset($value_user->confidentiality_status) && !empty($value_user->confidentiality_status)){
                            if ($value_user->confidentiality_status == 1){
                                $confidentiality_status = 1 ;
                            }
                        }

                        $file_3 = null;
                        if($broker == 'yes'){
                            if(isset($result[2]['p_id']) && !empty($result[2]['p_id'])){
                                $file_3 = $result[2]['p_id'];
                            }
                        }else{
                            if(isset($result[7]['p_id']) && !empty($result[7]['p_id'])){
                                $file_3 = $result[7]['p_id'];
                            }
                        }
                    @endphp
                    <div class="row d-flex justify-content-between align-items-center register-list-section-wrp" id="third">
                        <!-- number -->
                        <div class="col-md-1">
                            <div class="number @if($check_status == 1) @if($confidentiality_status == 1) check-number @endif @endif">3</div>
                        </div>
                        <!-- number Over-->
                        <!-- title -->
                        <div class="col-md-8">
                            <p class="main-title">VERTRAULICHKEITSVERPFLICHTUNG </p>
                            <p class="sub-title"><a href="{!!url('distribution_download') !!}/{{ $file_3 }}">(PDF Download)</a></p>
                        </div>
                        <!-- title Over-->
                        <!-- button -->
                        <div class="col-md-2 button-wrp">
                        @if($check_status == 1)
                            <form method="POST" enctype="multipart/form-data" id="confidentiality-store-file" action="javascript:void(0)">
                                <label class="book-2-upload-button button-1 @if($confidentiality_status == 1) active @endif">
                                    @if($confidentiality_status == 1)
                                    <input type="file" accept="application/pdf" name="confidentiality" id="pass_image_2"> liegt vor
                                    @else
                                    <input type="file" accept="application/pdf" name="confidentiality" id="pass_image_2"> ÖFFNEN
                                    @endif
                                </label>
                            </form>
                        @else
                            <label class="book-2-upload-button button-1">
                                ÖFFNEN
                            </label>
                        @endif

                        </div>
                        <!-- button Over-->
                        <!-- hover image -->
                        <div class="col-md-1 image-sec">
                            <div class="hover-image text-center @if($check_status == 1) @if($confidentiality_status == 1) check-image @endif @endif"></div>
                        </div>
                        <!-- hover image Over-->
                    </div>
                    <!-- 3 Over-->

                    <!-- 4 -->
                    @php
                        $avv_contract_status = 0 ;
                        if (isset($value_user->avv_contract_status) && !empty($value_user->avv_contract_status)){
                            if ($value_user->avv_contract_status == 1){
                                $avv_contract_status = 1 ;
                            }
                        }

                        $file_4 = null;
                        if($broker == 'yes'){
                            if(isset($result[3]['p_id']) && !empty($result[3]['p_id'])){
                                $file_4 = $result[3]['p_id'];
                            }
                        }else{
                            if(isset($result[8]['p_id']) && !empty($result[8]['p_id'])){
                                $file_4 = $result[8]['p_id'];
                            }
                        }
                    @endphp
                    <div class="row d-flex justify-content-between align-items-center register-list-section-wrp" id="fourth">
                        <!-- number -->
                        <div class="col-md-1">
                            <div class="number @if($check_status == 1) @if($avv_contract_status == 1) check-number @endif @endif">4</div>
                        </div>
                        <!-- number Over-->
                        <!-- title -->
                        <div class="col-md-8">
                            <p class="main-title">AV VERTRAG </p>
                            <p class="sub-title"><a href="{!!url('distribution_download') !!}/{{ $file_4 }}">(PDF Download)</a></p>
                        </div>
                        <!-- title Over-->
                        <!-- button -->
                        <div class="col-md-2 button-wrp">
                            @if($check_status == 1)
                                <form method="POST" enctype="multipart/form-data" id="avv-contract-store-file" action="javascript:void(0)">
                                    <label class="book-2-upload-button button-1 @if($avv_contract_status == 1) active @endif">
                                        @if($avv_contract_status == 1)
                                            <input type="file" accept="application/pdf" name="avv_contract"   id="pass_image_3"> liegt vor
                                        @else
                                            <input type="file" accept="application/pdf" name="avv_contract"   id="pass_image_3"> ÖFFNEN
                                        @endif
                                    </label>
                                </form>
                            @else
                                <label class="book-2-upload-button button-1">
                                    ÖFFNEN
                                </label>
                            @endif
                        </div>
                        <!-- button Over-->

                        <!-- hover image -->
                        <div class="col-md-1 image-sec">
                            <div class="hover-image text-center @if($check_status == 1) @if($avv_contract_status == 1) check-image @endif @endif"></div>
                        </div>
                        <!-- hover image Over-->
                    </div>
                    <!-- 4 Over-->

                    <!-- 5 -->
                    @php
                        $step_5_check = 0 ;
                        if (isset($value_user->step_5_check) && !empty($value_user->step_5_check)){
                            if ($value_user->step_5_check == 1){
                                $step_5_check = 1 ;
                            }
                        }

                        $file_5 = null;
                        if($broker == 'yes'){
                            if(isset($result[4]['p_id']) && !empty($result[4]['p_id'])){
                                $file_5 = $result[4]['p_id'];
                            }
                        }else{
                            if(isset($result[9]['p_id']) && !empty($result[9]['p_id'])){
                                $file_5 = $result[9]['p_id'];
                            }
                        }
                    @endphp
                    <div class="row d-flex justify-content-between align-items-center register-list-section-wrp" id="fifth">
                        <!-- number -->

                        <div class="col-md-1">
                            <div class="number @if($check_status == 1) @if($step_5_check == 1) check-number @endif @endif">5</div>
                        </div>
                        <!-- number Over-->
                        <!-- title -->
                        <div class="col-md-8">
                            <p class="main-title">DATENSCHUTZINFORMATIONEN </p>
                            <p class="sub-title"><a href="{!!url('distribution_download') !!}/{{ $file_5 }}">(PDF Download)</a></p>
                        </div>
                        <!-- title Over-->
                        <!-- button -->
                        <div class="col-md-2 button-wrp">
                            @if($check_status == 1)
                                <button class="button-1 step-5-btn @if($check_status == 1) @if($step_5_check == 1) active @endif @endif" onclick="ActionConfim('{{$id}}');">bestätigen</button>
                            @else
                                <button class="button-1 step-5-btn">bestätigen</button>
                            @endif
                        </div>
                        <!-- button Over-->

                        <!-- hover image -->
                        <div class="col-md-1 image-sec">
                            <div class="hover-image text-center @if($check_status == 1) @if($step_5_check == 1) check-image @endif @endif"></div>
                        </div>
                        <!-- hover image Over-->
                    </div>
                    <!-- 5 Over-->
                </div>
                <!-- register list dsection Over-->

                <!-- button -->
                <div class="col-md-10 col-lg-7 mx-auto mt-5">
                    <div class="row d-flex justify-content-between">
                        <!-- red button -->
                        {{--<div class="col-md-6">
                            <button class="red-button">KORREKTUR</button>
                        </div>--}}
                        <!-- red button Over-->

                        <!-- blue button -->
                        <div class="col-md-12">
                            <button class="blue-button">BESTÄTIGEN</button>
                        </div>
                        <!-- blue button Over-->
                    </div>

                    {{--<div class="col-md-12 pink-text">
                        <span class="blue-text">**</span>
                        Text zu Bedigungen der Registrierung ????<br>
                        Wir behalten uns vor .....
                    </div>--}}

                </div>
                <!-- button Over-->
            </div>
        </div>

    </div>


@stop

@section('footerscripts')

    <script src="{{front_assets}}/js/loadingoverlay.min.js"></script>
    <script src="{{front_assets}}/js/loadingoverlay_progress.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#distribution-store-file').change(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('distribution-store-file')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        // Show image container
                        $.LoadingOverlay("show");
                    },
                    success: (data) => {
                        this.reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                    },
                    error: function (data) {
                        alert('Fehler beim Hochladen! Bitte versuchen Sie es erneut!');
                    },
                    complete:function(result){
                        // Hide image container
                        $.LoadingOverlay("hide");
                    }
                });
            });

            $('#confidentiality-store-file').change(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('confidentiality-store-file')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        // Show image container
                        $.LoadingOverlay("show");
                    },
                    success: (data) => {
                        this.reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                    },
                    error: function (data) {
                        alert('Fehler beim Hochladen! Bitte versuchen Sie es erneut!');
                    },
                    complete:function(result){
                        // Hide image container
                        $.LoadingOverlay("hide");
                    }
                });
            });

            $('#avv-contract-store-file').change(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('avv-contract-store-file')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        // Show image container
                        $.LoadingOverlay("show");
                    },
                    success: (data) => {
                        this.reset();
                        setTimeout(function () {
                            location.reload(true);
                        }, 1000);
                    },
                    error: function (data) {
                        alert('Fehler beim Hochladen! Bitte versuchen Sie es erneut!');
                    },
                    complete:function(result){
                        // Hide image container
                        $.LoadingOverlay("hide");
                    }
                });
            });
        });
        function ActionConfim(con_id) {
            var tokenData = '{{ csrf_token() }}';
            var _token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                url: "{{URL::to('/action-confim')}}",
                data: {'id': con_id, '_token': tokenData},
                success: function (msg) {
                    if (msg == '0') {
                        $('#Step_5_Message').modal('show');
                    }
                }
            });
        }
    </script>
@stop
