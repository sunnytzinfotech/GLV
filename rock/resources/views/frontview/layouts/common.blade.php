<!DOCTYPE html>
<html>
<head>

    @php
        $site_data = App\Models\SiteSetting::all()->toArray();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{!! $site_data[0]['site_name'] !!}</title>

    <!-- FavLogo -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('uploads/')}}/{!! $site_data[0]['sflogo'] !!}">

    <!-- Bootstrap core CSS -->
    <link href="{{front_assets}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{front_assets}}/css/fontawesome.css">
    <link rel="stylesheet" href="{{front_assets}}/css/owl.css">
    <link rel="stylesheet" href="{{front_assets}}/css/intlTelInput.css">
    <link rel="stylesheet" href="{{front_assets}}/css/slick.css">
    <link rel="stylesheet" href="{{front_assets}}/css/slick-theme.css">
    <link href="{{admin_assets}}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="{{admin_assets}}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{front_assets}}/css/style.css">

    @yield('headerscripts')
</head>
<body>

@include('frontview.layouts.header')

@yield('content')

@include('frontview.layouts.footer')

<!-- Model Login -->
<div class="modal reg_model" id="myModal" style="display: none;" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">

                <div class="row h-100">
                    <div class="col-sm-6 my-auto" style="">
                        <div class="form-box box-login-padding">
                            @if($errors->any())
                                <div class="alert alert-danger text-center">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{$errors->first()}}
                                </div>
                            @endif
                            @if (\Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {!! \Session::get('success') !!}
                                </div>
                            @endif

                            @if (\Session::has('error'))
                                <div class="alert alert-danger text-center">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {!! \Session::get('error') !!}
                                </div>
                            @endif
                            <h3 class="login-title">LOGIN</h3>
                            <form action="{{route('login')}}" id="login-form" method="post" autocomplete="off">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control">
                                    <label>E-Mail</label>
                                </div>
                                <div class="form-group">
                                    <div class="input-group eye-icon">
                                        <input type="password" name="password" class="form-control ckeck-password">
                                        <i class="fa fa-eye password-show"  aria-hidden="true"></i>
                                    </div>

                                    <label>Passwort</label>

                                </div>
                                <div class="text-center mt2">
                                    <button class="next-btn upper">SENDEN</button>
                                </div>
                            </form>
                            <div class="options text-center text-md-right mt-3">
                                <p><a href="javascript:void(0);" class="blue-text font-italic" data-toggle="modal" data-target="#forget" data-dismiss="modal">Passwort vergessen?</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#RegisterModal" data-toggle="modal" data-target="#RegisterModal" class="text-color-black"
                           id="model_1" data-dismiss="modal">
                            <div class="form-box box-1-padding box-1-color">
                                <h3>REGISTRIEREN</h3>
                                <p class="font-italic">Hier können Sie sich registrieren</p>
                            </div>
                        </a>
                        <div class="form-box box-2-padding box-2-color box-text-color">
                            <h3>KONTAKT</h3>
                            <p class="font-italic">Rückruf erwünscht</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" name=""
                                           class="form-control border border-white bg-transparent text-white">
                                    <p class="dis-block">Telefonnummer*</p>
                                    <div class="small_check_text" >
                                    <input type="checkbox" class="d-inline-block" id="chk_agree" name="chk_agree"
                                           required="">*Ja, ich habe die</h6> <a href="#" class="blue-text text-decoration-none">Datenschutzhinweise </a> gelesen und erkläre mich damit einverstanden.
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
<!-- Model Login Over -->

<!-- Model Register -->
<div class="modal fade registration-modal bd-example-modal-lg" id="RegisterModal" tabindex="-1" role="dialog"
     aria-labelledby="RegisterModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal_cus_reg" role="document">
        <div class="modal-content rounded-0 pb-3">
            <!-- header -->
            <div class="modal-header registration-modal-header ">
                <div class="pl-80 pr-80" >
                <h1>Deutschlands großes <br><span class="blue-text" >Tipp</span>geber-Portal</h1><br>
                <h2>fair, transparent und einfach bedienbar</h2>
                </div>
            </div>
            <!-- header Over-->

            <!-- content -->
            <div class="modal-body pl-80 pr-80">
                <div class="registration-modal-content">
                    <div class="row d-flex justify-content-between">
                        <!-- heading -->
                        <div class="col-md-8 col-lg-8">
                            <h3 class="blue-text">REGISTRIERUNG</h3>
                            <h4>Liebe Interessentin, lieber Interessent,</h4>
                        </div>
                        <!-- heading Over-->

                        <!-- image -->
                        <div class="col-md-4 col-lg-4 text-right">
                            <img src="{{front_assets}}/images/registration-modal-image.png" class="img-fluid reg-modal-image" alt="">
                        </div>
                        <!-- image Overt-->
                    </div>

                    <!-- text -->
                    <div class="col-md-12 p-0">
                        <p>
                            für Deine Registrierung als Tippgeber benötigen wir einige Angaben. Diese Daten werden nur bei uns gespeichert und in keinerlei Weise an Dritte weitergegeben. Ebenso taucht Dein Name weder auf Versicherungspolicen,
                            Beitragsrechnungen oder dergleichen auf.
                        </p>
                        <p>
                            Nachdem Du die Formularfelder dieser Seite ausgefüllt und versandt hast, leiten wir Dich weiter durch den Registrierungsprozess. So erhältst Du leicht und unkompliziert die ersten Tippgeberprovisionen.
                        </p>
                        <p>
                            Solltest Du an dieser Stelle bereits Fragen haben, kannst Du uns ganz einfach <a href="tel:+49(0)5121" ><span class="blue-text">anrufen</span></a> oder per <a href="mailto:info@glv-makler.de" ><span class="blue-text">E-Mail</span></a> kontaktieren.
                        </p>
                    </div>
                    <!-- text Over-->

                    <!-- form -->
                    <form action="{{action('Frontend\IndexController@doSignup')}}" id="signup-form" method="post" autocomplete="off">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <!-- check box -->
                        <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                            <div class="col-md-12 col-lg-6 ">
                                <ul class="list-unstyled list-inline mt-3">
                                    <li class="list-inline-item">
                                        <div class="d-flex align-items-center">
                                            <label for="Frau">Frau</label>
                                            <input type="radio" name="frau" id="Frau" class="check-box-css mt-0" checked value="frau"/>
                                        </div>

                                    </li>

                                    <li class="list-inline-item ml-4">
                                        <div class="d-flex align-items-center">
                                            <label for="Herr">Herr</label>
                                            <input type="radio" name="frau" id="Herr" class="check-box-css mt-0" value="herr"/>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-6">
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

                        <!-- check box -->
                        <div class="row d-flex justify-content-between mt-3">
                            <div class="col-md-12 col-lg-6 d-flex align-items-center">
                                <div class="pr-2" >
                                    <input type="radio" name="broker" id="Ich" class="check-box-css mt-0" value="yes"/>
                                </div>
                                <div>
                                    <label for="Ich">Ich bin Makler</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 d-flex align-items-center">
                                <div class="width-10 pr-2" >
                                <input type="radio" name="broker" id="bin" class="check-box-css mt-0" checked value="no"/>
                                </div>
                                <div class="width-90" >
                                    <label for="bin">Ich bikler bin <strong>kein</strong> Makler, möchte aber Tippgeber werden.</label>
                                </div>
                            </div>
                        </div>
                        <!-- check box Over-->

                        <!-- input -->
                        <div class="row registration-modal-input-fields">
                            <div class="col-md-12 mt-3">
                                <label>ggfs. Anmerkung</label><br>
                                <input type="text" name="anmerkung">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>E-Mail [für Registrierung und Schriftverkehr]<span
                                        class="blue-text">*</span></label><br>
                                <input type="email" required name="email" id="email">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Password für Login<span
                                        class="blue-text">*</span></label><br>
                                <input type="password" required name="password" id="password">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Telefon</label><br>
                                <input type="number" name="number" placeholder="+1234567890">
                            </div>
                        </div><br>
                        <h6>Ich bin auf <b>GLV Tippgeber</b> aufmerksam geworden durch:</h6>


                        <!-- check box -->
                        <div class="row d-flex justify-content-between mt-3">
                            <div class="col-md-12 d-flex align-items-center">
                                <div class="pr-2" >
                                    <input type="radio" name="insurance_broker" id="Ich" class="check-box-css mt-0" value="1"/>
                                </div>
                                <div>
                                    <label for="Ich">Durch die Facebook-Gruppe „Versicherungsvermittler Deutschland“</label>
                                </div>
                            </div><br><br>

                            <div class="col-md-12 d-flex align-items-center">
                                <div class="pr-2" >
                                    <input type="radio" name="insurance_broker" id="bin" class="check-box-css mt-0" checked value="2"/>
                                </div>
                                <div class="width-90">
                                    <label for="bin">Durch die Facebook-Gruppe „Versicherungsmaklerforum Deutschland“</label>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex align-items-center">
                                <div class="pr-2">
                                    <input type="radio" name="insurance_broker" id="Ins" class="check-box-css mt-0" value="3"/>
                                    <label>Empfohlen von</label>
                                </div>
                                <div class="row registration-modal-input-fields">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="recommanded_details" id="recommanded">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex align-items-center">
                                <div class="pr-5" >
                                    <input type="radio" name="insurance_broker" id="Insf" class="check-box-css mt-0" value="4"/>
                                    <label>Sonstiges:</label>
                                </div>
                                <div class="row registration-modal-input-fields">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea id="other" name="other_details" rows="3" cols="65"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- input Over-->

                        <div class="form-check mt-3">
                            <input type="checkbox" class="check-box-css check-box-css-terms form-check-input"
                                   id="terms" required name="terms">
                            <p class="terms-text">
                                Ich erkläre mich mit den <a href="#" class="blue-text">Datenschutzbestimmungen</a> und
                                <a href="#" class="blue-text">Nutzungsbedingungen</a> von <strong>GLV Versicherungsservice GmbH</strong> einverstanden und bin älter als 16 Jahre.
                            </p>
                        </div>

                        <div class="col-md-12 input-number-text">
                            <div class="row mx-auto" style="align-items: baseline;">
                                <p>Zeigen Sie, dass Sie kein Bot sind: </p>
                                <input type="number" name="conform_number" id="conform_number">
                                @php
                                    $rang = rand(1,50);
                                    $rang1 = rand(51,100);
                                @endphp
                                <p class="ml-2">+ {!! $rang !!} = {!! $rang1 !!}</p>
                                <input type="hidden" name="number1" value="{!! $rang !!}" id="number1">
                                <input type="hidden" name="total" value="{!! $rang1 !!}" id="total">
                            </div>
                        </div>

                        <div class="row mx-auto d-flex justify-content-between input-number-text align-items-center mt-5">
                            <div class="col-md-6">
                                <p class="font-italic text-muted mt-0"><span class="blue-text">*</span>Pflichtfelder</p>
                            </div>
                            <div class="col-md-6 text-right pr-0">
                                <!-- <a href="#" class="next-btn" data-toggle="modal" data-target="#ThankyouModal" data-dismiss="modal">SENDEN</a> -->
                                <button class="next-btn" type="submit" value="Signup" name="submit">SENDEN</button>
                                <!-- <a href="#" class="next-btn" data-toggle="modal" data-target="#ThankyouModal" data-dismiss="modal">SENDEN</a> -->
                            </div>
                        </div>
                    </form>
                    <!-- form Over-->
                </div>
            </div>
            <!-- content Over-->
            <div class="modal-footer border-0 pl-80 pr-80">
                <small class="blue-text">schließen</small>
                <button type="button" class="modal-close-button shadow" data-dismiss="modal">
                    X
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Model Register Over -->

<!-- thank you modal -->
<div class="modal fade bd-example-modal-lg thank-you-modal" tabindex="-1" role="dialog" aria-hidden="true" id="ThankyouModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body registration-modal ">

                <!-- heading -->
                <div class="registration-modal-content">
                    <h3 class="blue-text">HERZLICHEN DANK FÜR IHRE ANMELDUNG!</h3>
                    <p class="thank-you-sub-text">Nur noch wenige Schritte, dann ist Ihre Registrierung komplett.</p>
                    <h4 class="thank-you-h4">Sie erhalten nun einen Bestätigungslink an die von Ihnen angegebene E-Mail Adresse.
                        Bitte bestätigen Sie den Link! Dann können wir Ihre Registrierung abschließen.</h4>
                    <p class="thank-you-text">
                        Sollten Sie noch Fragen haben, können Sie uns gerne <a href="tel:+49(0)5121">anrufen</a> oder <a href="mailto:info@glv-makler.de">schreiben.</a>
                    </p>
                </div>
                <!-- heading Over-->

            </div>

        </div>
    </div>
</div>
<!-- thank you modal Over-->

<!-- Model After Register -->
<div class="modal fade registration-modal bd-example-modal-lg" id="RegisterModal1" tabindex="-1" role="dialog"
     aria-labelledby="RegisterModal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal_cus_reg" role="document">
        <div class="modal-content rounded-0 pb-3">
            <!-- header -->

            <div class="modal-header registration-modal-header">
                <div class=" pl-80 pr-80" >
                    <h1>Willkommen zurück !</h1><br>
                    <h2>Schön, Dich hier wieder zu sehen. Es ist auch gleich geschafft !</h2>
                </div>
            </div>
            <!-- header Over-->

            <!-- content -->
            <div class="modal-body  pl-80 pr-80">
                <div class="registration-modal-content">
                    <div class="row d-flex justify-content-between">
                        <!-- heading -->
                        <div class="col-md-8 col-lg-8">
                            <h3 class="blue-text">REGISTRIERUNG ... <span>Fortsetzung</span></h3>
                        </div>
                        <!-- heading Over-->

                        <!-- image -->
                        <div class="col-md-4 col-lg-4 text-right">
                            <img src="{{front_assets}}/images/registration-modal-image.png" class="img-fluid reg-modal-image"
                                 alt="">
                        </div>
                        <!-- image Overt-->
                    </div>

                    <!-- text -->
                    <div class="col-md-12 p-0">
                        <p>
                            Für die Vervollständigung Deines Profils benötigen wir noch einige Angaben von Dir. Fülle einfach die folgenden Formularfelder dieser Seite aus und gehe auf SENDEN. Anschließend findest Du alle vertragsrelevanten Verträge zum Uploaden und Bestätigen.
                        </p>
                        <p>
                            Innerhalb von 24 Stunden wird Deine Registrierung von uns bearbeitet und per E-Mail bestätigt<span class="blue-text">**</span>. Solltest Du an dieser Stelle bereits Fragen haben, kannst Du uns ganz einfach <a href="tel:+49(0)5121" ><span class="blue-text">anrufen</span></a> oder per <a href="mailto:info@glv-makler.de" ><span class="blue-text">E-Mail</span></a> kontaktieren.
                        </p>
                        {{-- <p>
                            Solltest Du an dieser Stelle bereits Fragen haben, kannst Du uns ganz einfach <span class="blue-text">anrufen</span> oder per <span class="blue-text">E-Mail</span> kontaktieren.
                        </p> --}}
                    </div>
                    <!-- text Over-->

                    <!-- form -->
                    <form action="{{action('Frontend\IndexController@doRegister')}}" id="register-form" method="post" autocomplete="off">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <!-- check box -->
                        @php
                            $auth = Auth::user();
                            if(isset($auth) && !empty($auth)){
                                $id = $auth->id;

                                if(isset($id) && !empty($id)){
                                   $result = App\Models\UserDetail::where('user_id', $id)->first();
                                }
                            }
                        @endphp
                        <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                            <div class="col-md-12 col-lg-6 ">
                                <ul class="list-unstyled list-inline mt-3">
                                    <li class="list-inline-item">
                                        <div class="d-flex align-items-center">
                                            <label for="Frau">Frau</label>
                                            @php
                                                $checked = '';
                                                if(isset($auth) && !empty($auth)){
                                                    if($auth->mr_mrs == 'frau'){
                                                        $checked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input type="radio" name="frau" id="Frau" class="check-box-css mt-0" value="frau" {{$checked}} />
                                        </div>
                                    </li>

                                    <li class="list-inline-item ml-4">
                                        <div class="d-flex align-items-center">
                                            <label for="Herr">Herr</label>
                                            @php
                                                $checked = '';
                                                if(isset($auth) && !empty($auth)){
                                                    if($auth->mr_mrs == 'herr'){
                                                        $checked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input type="radio" name="frau" id="Herr" class="check-box-css mt-0" value="herr" {{$checked}}/>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <ul class="list-unstyled list-inline mt-3">
                                    <li class="list-inline-item">
                                        <div class="d-flex align-items-center">
                                            <label for="Frau">Frau</label>
                                            @php
                                                $checked = '';

                                                if(isset($result->frau1) && !empty($result->frau1)){
                                                    if($result->frau1 == 'on'){
                                                        $checked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <input type="checkbox" name="frau1" id="Frau1" class="check-box-css mt-0" value="on" {{$checked}} />
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
                                <input type="text" required name="nachname" value="@if(isset($auth->user_name)&&!empty($auth->user_name)){{$auth->user_name}}@endif">
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label>Vorname<span class="blue-text">*</span></label><br>
                                <input type="text" required name="vorname" value="@if(isset($auth->last_name)&&!empty($auth->last_name)){{$auth->last_name}}@endif">
                            </div>
                        </div>
                        <!-- names Over-->

                        <!-- input -->
                        <div class="row registration-modal-input-fields">
                            <div class="col-md-12 mt-3">
                                <label>Unternehmen / Firmierung<span class="blue-text">*</span></label><br>
                                <input type="text" required name="unternehmen" value="@if(isset($result->unternehmen)&&!empty($result->unternehmen)){{$result->unternehmen}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Straße, Hausnummer</label><br>
                                <input type="text" name="strabe" value="@if(isset($result->strabe)&&!empty($result->strabe)){{$result->strabe}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>PLZ + Ort<span class="blue-text">*</span></label><br>
                                <input type="text" required name="plzort" value="@if(isset($result->plzort)&&!empty($result->plzort)){{$result->plzort}}@endif">
                            </div>
                            <div class="col-md-12 mt-3 date">
                                <label>Geburtsdatum</label><br>
                                <div class="input-group date">
                                                    <span class="input-group-addon display-none">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                    @php
                                        $dob_date = '';
                                        if(isset($result->geburtsdatum)&&!empty($result->geburtsdatum)){

                                            $dob_date = strtotime($result->geburtsdatum);
                                            $dob_date = date("d/m/Y",$dob_date);
                                        }
                                    @endphp
                                    <input type="text" class="form-control" name="geburtsdatum" value="{{$dob_date}}" placeholder="Tag.Monat.Jahr">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>IHK Registrierungsnummer<span class="blue-text">*</span></label><br>
                                <input type="text" required name="ihkregister" value="@if(isset($result->ihkregister)&&!empty($result->ihkregister)){{$result->ihkregister}}@endif">
                            </div>
                            <?php
                                    $today_date = date("d/m/Y");
                                    $admin_confirm = '';
                                    if($auth){
                                        $admin_confirm = $auth->admin_confirm;
                                    }
                                ?>

                            <div class="col-md-12 mt-3 @if(isset($admin_confirm) && !empty($admin_confirm)) @else date @endif">

                                <label>Beginn des Tippgeber-Vertrages</label><br>
                                <div class="input-group @if(isset($admin_confirm) && !empty($admin_confirm)) @else date @endif">
                                    <span class="input-group-addon display-none">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" @if(isset($admin_confirm) && !empty($admin_confirm))  @else name="beginndes"  @endif  class="form-control" value="@if(isset($result->beginndes)&&!empty($result->beginndes)){{$result->beginndes}}@else{{$today_date}}@endif" @if(isset($admin_confirm) && !empty($admin_confirm)) readonly="" @else  @endif placeholder="Tag.Monat.Jahr">
                                </div>
                            </div>
                            <h4 class="ml-3">Weitere Kontaktdaten</h4>

                            <div class="col-md-12 mt-3">
                                <label>Telefon<span class="blue-text">*</span></label><br>
                                <input type="number" name="telefon" value="@if(isset($auth->phone)&&!empty($auth->phone)){{$auth->phone}}@endif" placeholder="+1234567890">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>E-Mail</label><br>
                                <input type="email" name="email1" value="@if(isset($auth->email)&&!empty($auth->email)){{$auth->email}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>E-Mail für Abrechnung<span class="blue-text">*</span></label><br>
                                <input type="text" required name="email2" value="@if(isset($result->email2)&&!empty($result->email2)){{$result->email2}}@endif">
                            </div>

                            <h4 class="ml-3 mt-6">Bankverbindung</h4>
                            <div class="col-md-12 mt-3">
                                <label>IBAN</label><br>
                                <input type="text" name="iban" value="@if(isset($result->iban)&&!empty($result->iban)){{$result->iban}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Name der Bank</label><br>
                                <input type="text" name="bankdetail" value="@if(isset($result->bankdetail)&&!empty($result->bankdetail)){{$result->bankdetail}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Kontoinhaber<span class="blue-text">*</span></label><br>
                                <input type="text" required name="kontoinhaber" value="@if(isset($result->kontoinhaber)&&!empty($result->kontoinhaber)){{$result->kontoinhaber}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Weitere Ansdprechpartner <small>(ggfs. z.B. Versicherungsagentur)</small></label><br>
                                <input type="text" name="weitere" value="@if(isset($result->weitere)&&!empty($result->weitere)){{$result->weitere}}@endif">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label>Sonstige Anmerkungen</label><br>
                                <textarea name="sonsge">@if(isset($result->sonsge)&&!empty($result->sonsge)){{$result->sonsge}}@endif</textarea>
                            </div>
                        </div>
                        <!-- input Over-->

                        <div class="form-check mt-3">
                            <input type="checkbox" class="check-box-css check-box-css-terms form-check-input"
                                   id="terms1" required name="terms">
                            <p class="terms-text">
                                Ich akzeptiere die <a href="#" class="blue-text">AGB</a> und <a href="#" class="blue-text">Datenschutzerklärung</a>
                            </p>
                        </div>

                        <div class="col-md-12 input-number-text">
                            <div class="row mx-auto" style="align-items: baseline;">
                                <p>Zeigen Sie, dass Sie kein Bot sind: </p>
                                <input type="number" name="conform_number" id="conform_number1">
                                @php
                                    $rang = rand(1,50);
                                    $rang1 = rand(51,100);
                                @endphp
                                <p class="ml-2">+ {!! $rang !!} = {!! $rang1 !!}</p>
                                <input type="hidden" name="number1" value="{!! $rang !!}" id="number11">
                                <input type="hidden" name="total" value="{!! $rang1 !!}" id="total1">
                                <input type="hidden" name="user_id" value="@if(isset($auth->id)&&!empty($auth->id)){{$auth->id}}@endif">
                            </div>
                        </div>

                        <div
                            class="row mx-auto d-flex justify-content-between input-number-text align-items-center mt-5">
                            <div class="col-md-7">
                                <p class="font-italic text-muted mt-0"><span class="blue-text">*</span>Pflichtfelder</p>
                                <p class="font-italic text-muted mt-0"><span class="blue-text">**</span>Text zu Bedigungen der Registrierung ????<br>Wir behalten uns vor .....</p>
                            </div>
                            <div class="col-md-5 text-right pr-0">
                                <button class="next-btn" type="submit" value="Signup" name="submit">SENDEN</button>
                            </div>
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
<!-- Model After Register Over -->

<!-- Model Forget -->
<div class="modal reg_model" id="forget" style="display: none;" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">

                <div class="row h-100">
                    <div class="col-sm-6 my-auto" style="">
                        <div class="form-box box-login-padding">


                            <div class="alert alert-danger text-center div_forget_error" style="display: none;">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <p style="margin: 0; font-size: 13px;"></p>
                            </div>

                            <div class="alert alert-success text-center div_forget_success" style="display: none;">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <p style="margin: 0; font-size: 13px;"></p>
                            </div>

                            <h3 class="login-title">Passwort Vergessen</h3>
                            <form action="javascript:void(0)" id="forget-form" autocomplete="off">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="forgetemail">
                                    <label>E-Mail</label>
                                </div>
                                <div class="text-center mt2">
                                    <button class="next-btn upper" type="button" id="btn_forget" value="submit">SENDEN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#RegisterModal" data-toggle="modal" data-target="#RegisterModal" class="text-color-black"
                           id="model_1" data-dismiss="modal">
                            <div class="form-box box-1-padding box-1-color">
                                <h3>REGISTRIEREN</h3>
                                <p class="font-italic">Hier können Sie sich registrieren</p>
                            </div>
                        </a>
                        <div class="form-box box-2-padding box-2-color box-text-color">
                            <h3>KONTAKT</h3>
                            <p class="font-italic">Rückruf erwünscht</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" name=""
                                           class="form-control border border-white bg-transparent text-white">
                                    <p class="dis-block">Telefonnummer*</p>
                                    <div class="small_check_text" >
                                    <input type="checkbox" class="d-inline-block" id="chk_agree" name="chk_agree"
                                           required="">*Ja, ich habe die</h6> <a href="#" class="blue-text text-decoration-none">Datenschutzhinweise </a> gelesen und erkläre mich damit einverstanden.
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
<!-- Model Forget Over -->

<!-- Model message -->
<div class="modal reg_model" id="message" style="display: none;" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">

                <div class="row h-100">
                    <div class="col-sm-6 my-auto" style="">
                        <div class="form-box box-login-padding">

                            <h3>Password Reset successfully</h3>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#RegisterModal" data-toggle="modal" data-target="#RegisterModal" class="text-color-black"
                           id="model_1" data-dismiss="modal">
                            <div class="form-box box-1-padding box-1-color">
                                <h3>REGISTRIEREN</h3>
                                <p class="font-italic">Hier können Sie sich registrieren</p>
                            </div>
                        </a>
                        <div class="form-box box-2-padding box-2-color box-text-color">
                            <h3>KONTAKT</h3>
                            <p class="font-italic">Rückruf erwünscht</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" name=""
                                           class="form-control border border-white bg-transparent text-white">
                                    <small class="dis-block">Telefonnummer*</small>
                                    <input type="checkbox" class="d-inline-block" id="chk_agree" name="chk_agree"
                                           required="">*Ja, ich habe die
                                    <a href="#" class="blue-text text-decoration-none">Datenschutzhinweise </a>
                                    gelesen
                                    und erkläre mich damit einverstanden.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- Model message Over -->

<!-- Model message1 -->
<div class="modal reg_model" id="message1" style="display: none;" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">

                <div class="row h-100">
                    <div class="col-sm-6 my-auto" style="">
                        <div class="form-box box-login-padding">

                            <h3>Password link expired please try again!</h3>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="#RegisterModal" data-toggle="modal" data-target="#RegisterModal" class="text-color-black"
                           id="model_1" data-dismiss="modal">
                            <div class="form-box box-1-padding box-1-color">
                                <h3>REGISTRIEREN</h3>
                                <p class="font-italic">Hier können Sie sich registrieren</p>
                            </div>
                        </a>
                        <div class="form-box box-2-padding box-2-color box-text-color">
                            <h3>KONTAKT</h3>
                            <p class="font-italic">Rückruf erwünscht</p>
                            <form>
                                <div class="form-group">
                                    <input type="text" name=""
                                           class="form-control border border-white bg-transparent text-white">
                                    <small class="dis-block">Telefonnummer*</small>
                                    <input type="checkbox" class="d-inline-block" id="chk_agree" name="chk_agree"
                                           required="">*Ja, ich habe die
                                    <a href="#" class="blue-text text-decoration-none">Datenschutzhinweise </a>
                                    gelesen
                                    und erkläre mich damit einverstanden.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- Model message1 Over -->

<!-- Model Step 5 Message -->
<div class="modal fade registration-modal bd-example-modal-lg" id="Step_5_Message" tabindex="-1" role="dialog"
     aria-labelledby="RegisterModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content rounded-0 pb-3">
            <!-- content -->
            <div class="modal-body registration-modal ">

                <!-- heading -->
                <div class="registration-modal-content" style="padding: 50px 60px 0px 60px;">
                    <h3 class="blue-text">HERZLICHEN DANK FÜR IHRE ANMELDUNG!</h3>
                    <p class="thank-you-sub-text">Nur noch wenige Schritte, dann ist Ihre Registrierung komplett.</p>
                    <h4 class="thank-you-h4">Sie erhalten nun einen Bestätigungslink an die von Ihnen angegebene E-Mail Adresse.
                        Bitte bestätigen Sie den Link! Dann können wir Ihre Registrierung abschließen.</h4>
                    <p class="thank-you-text">
                        Sollten Sie noch Fragen haben, können Sie uns gerne <a href="#">anrufen</a> oder <a href="#">schreiben.</a>
                    </p>
                </div>
                <!-- heading Over-->

            </div>
            <!-- content Over-->
            <div class="modal-footer border-0">
                <small class="blue-text">schließen</small>
                <button type="button" class="modal-close-button shadow reload_page" data-dismiss="modal" >
                    X
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Model Step 5 Message Over -->

<!-- Model Message Send -->
<div class="modal reg_model" id="sendMessage" style="display: visible;" aria-hidden="true" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">

                <div class="row h-100">
                    <div class="col-sm-12 my-auto" style="">
                        <div class="form-box box-login-padding">
                            <h3 class="login-title">Number</h3>
                            <form action="{{route('send-message')}}" id="login-form" method="post" autocomplete="off">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <input type="tel" name="number" class="form-control" id="phone" onkeypress="return isNumber(event)">
                                    <input type="hidden" value="" class="phone_code" name="phone_code">
                                    <input type="hidden" value="" name="popup_id" id="popup_id">
                                    {{--<label class="font-italic">Name</label>--}}
                                </div>
                                <div class="text-center mt2">
                                    <button class="next-btn upper">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <small class="blue-text">schließen</small>
                <button type="button" class="modal-close-button shadow" data-dismiss="modal">
                    X
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Model Message Send -->

<!-- Model denie user -->
<div class="modal fade registration-modal bd-example-modal-lg" id="masonry_denie" tabindex="-1" role="dialog" aria-labelledby="masonry_model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
    <div class="modal-content rounded-0 pb-3">

        <!-- content -->
        <div class="modal-body">
            <div class="row" >
                <div class="col-sm-9 mt-2 pl-0" >
                    <h1 class="masonry_denie_title" >Deine Registrierung ist noch nicht bestätigt!</h1>
                    <p>Sobald Deine Registrierung bestätigt ist, kannst Du unser <br/>
                        Tippgeber-Portal in vollem Umfang nutzen.
                    <p>
                    <p>
                        Solltest Du Fragen haben, dann <span class="blue-text" >ruf uns</span> gerne an order kontaktier uns per <span class="blue-text" >E-Mail.</span>
                    </p>
                </div>
                <div class="col-sm-3" >
                    <img src="{{front_assets.'/images/warning_modal.png'}}" class="img-fluid" >
                </div>
            </div>
        </div>
        <!-- content Over-->
        <div class="pl-3 border-0">
            <span class="modal-close-button border-0" data-dismiss="modal" ><img src="{{front_assets.'/images/back.png'}}"></span>
            <small class="blue-text">zurück</small>
        </div>

    </div>
    </div>
</div>
<!-- Model denie user -->

<!-- Bootstrap core JavaScript -->
<script src="{{front_assets}}/js/jquery.min.js"></script>
<script src="{{admin_assets}}/js/plugins/validate/jquery.validate.min.js"></script>
<script src="{{front_assets}}/js/bootstrap.bundle.min.js"></script>
<script src="{{front_assets}}/js/masonry.pkgd.min.js"></script>



<!-- Additional Scripts -->
<script src="{{front_assets}}/js/custom.js"></script>
<script src="{{front_assets}}/js/owl.js"></script>
<script src="{{front_assets}}/js/slick.js"></script>
<script src="{{front_assets}}/js/isotope.js"></script>
<script src="{{front_assets}}/js/accordions.js"></script>
<script src="{{admin_assets}}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="{{front_assets}}/js/jquery.binarytransport.js"></script>

<script src="{{front_assets}}/js/intlTelInput.min.js"></script>
<script src="{{front_assets}}/js/intlTelInput-jquery.min.js"></script>
<!-- Jaydeep Put Scripts -->
<!-- <script src="{{front_assets}}/js/font-awesome.js"></script> -->

@yield('footerscripts')
<script>
$('#recommanded').hide();
    $('#other').hide();
$('input[name="insurance_broker"]').click(function(e) {
  if(e.target.value === '3') {
    $('#recommanded').show();
    $('#other').hide();
  } else if(e.target.value === '4'){
    $('#recommanded').hide();
    $('#other').show();
  }else{
    $('#recommanded').hide();
    $('#other').hide();
  }
});

</script>
<script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) {                   //declaring the array outside of the
        if (!cleared[t.id]) {                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value = '';         // with more chance of typos
            t.style.color = '#fff';
        }
    }
</script>
<script>
    function openNav() {
        document.getElementById("navbarResponsive").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("navbarResponsive").style.width = "0";
    }

    $('.search_btn').click(function () {
        $('.search_pop').slideToggle(200);
    });
    $('#login_header').click(function () {
        closeNav(1, false);
    });
</script>
<script>

    $(function () {
        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");

        $("#signup-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{URL::to('varifyemail')}}",
                        type: "POST",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },
                            _token: "{{ csrf_token() }}",
                        }
                    }
                },
                nachname: {
                    required: true,
                },
                vorname: {
                    required: true,
                },
                conform_number: {
                    required: true,
                    remote: {
                        url: "{{URL::to('varifytotal')}}",
                        type: "POST",
                        data: {
                            conform_number: function () {
                                return $("#conform_number").val();
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
                frau: {
                    required: true,
                },
                password: {
                    required: true,
                    noSpace: true
                },
                broker: {
                    required: true,
                },

            },
            messages: {

                email: {
                    remote: "Die E-Mail-Adresse ist bereits vergeben.",
                    email: "Bitte E-Mail eingeben!",
                    required: "Bitte E-Mail eingeben!",
                },
                nachname: {
                    required: "Bitte Nachnamen eingeben!"
                },
                vorname: {
                    required: "Bitte Vornamen eingeben!"
                },
                conform_number: {
                    required: "Bitte den richtigen Wert eingeben!",
                    remote: "Bitte den richtigen Wert eingeben!"
                },
            }
        });
    });
    $(function () {
        $("#register-form").validate({
            rules: {
                email2: {
                    required: true,
                    email: true,
                },
                telefon:{
                  required: true,
                },
                unternehmen: {
                    required: true,
                },
                kontoinhaber: {
                    required: true,
                },
                conform_number: {
                    required: true,
                    remote: {
                        url: "{{URL::to('varifytotal')}}",
                        type: "POST",
                        data: {
                            conform_number: function () {
                                return $("#conform_number1").val();
                            },
                            number1: function () {
                                return $("#number11").val();
                            },
                            total: function () {
                                return $("#total1").val();
                            },
                            _token: "{{ csrf_token() }}",
                        }
                    }
                },
                // iban: {
                //     required: true,
                // },
                ihkregister: {
                    required: true,
                },
                plzort: {
                    required: true,
                },

            },
            messages: {
                conform_number: {
                    required: "Bitte den richtigen Wert eingeben!",
                    remote: "Bitte den richtigen Wert eingeben!"
                },
                telefon: {
                    required: "Bitte geben Sie eine gültige Nummer ein.",
                }
            }
        });
    });
    $(function () {
        $("#reset-form").validate({
            rules: {
                new_password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    minlength: 5,
                    equalTo: "#new_password"
                }

            }
        });
    });
</script>
<script>
    $(function () {

        var tokenData = '{{ csrf_token() }}';

        $("#forgetemail").val('');

        $('.div_forget_error p').html("");
        $('.div_forget_success p').html("");

        $("#btn_forget").prop("disabled", false);


        $("#btn_forget").click(function (e) {
            e.preventDefault();

            $('.div_forget_error p').html("");
            $('.div_forget_success p').html("");

            $('.div_forget_error').hide();
            $('.div_forget_success').hide();


            var email = $("#forgetemail").val();

            if (email != '') {

                $.ajax({
                    type: "POST",
                    url: "{{URL::to('/forgot_passwords')}}",
                    data: {
                        '_token': tokenData,
                        email: $("#forgetemail").val()
                    },
                    success: function (result) {

                        $("#btn_forget").prop("disabled", false);

                        if (result == "success") {

                            $('.div_forget_success p').html("Das Passwort ist zurückgesetzt. Bitte überprüfen Sie Ihre E-Mails!");
                            $('.div_forget_success').show();

                            $("#btn_forget").prop("disabled", true);

                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);

                        } else if (result == "email_not_found") {

                            $('.div_forget_error p').html("E-Mail wurde nicht gefunden.");
                            $('.div_forget_error').show();

                        } else if (result == "error") {

                            $('.div_forget_error p').html("Passwort nicht zurückgesetzt! Bitte versuchen Sie es erneut!");
                            $('.div_forget_error').show();

                        } else {

                            $('.div_forget_error p').html("Etwas ist schief gelaufen!");
                            $('.div_forget_error').show();
                        }

                    }
                });
            } else {

                $('.div_forget_error p').html("Bitte E-Mail eingeben!.");
                $('.div_forget_error').show();

            }
        });
    });
</script>

@if(!empty(Session::get('code')) && Session::get('code') == 1)
    <script>
        $(function () {
            $('#ThankyouModal').modal('show');
        });
    </script>
@endif

@if(!empty(Session::get('code')) && Session::get('code') == 2)
    <script>
        $(function () {
            $('#myModal').modal('show');
        });
    </script>
@endif

@if(!empty(Session::get('code')) && Session::get('code') == 3)
    <script>
        $(function () {
            $('#RegisterModal1').modal('show');
        });
    </script>
@endif

@if(!empty(Session::get('code')) && Session::get('code') == 4)
    <script>
        $(function () {
            $('#forget').modal('show');
        });
    </script>
@endif

@if(!empty(Session::get('code')) && Session::get('code') == 5)
    <script>
        $(function () {
            $('#message').modal('show');
        });
    </script>
@endif

@if(!empty(Session::get('code')) && Session::get('code') == 6)
    <script>
        $(function () {
            $('#message1').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(function () {
        var dateToday = new Date();
        $('.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            viewMode: 0,
            startDate: dateToday,
        });
    });
    $( ".reload_page" ).click(function() {
        location.reload();
    });
</script>
<script>
    /*$(document).ready(function () {
        telephone1_iti = $('#phone').intlTelInput({
            separateDialCode: true
        });

        $('.next-btn').click(function(){
            var countryData = telephone1_iti.intlTelInput("getSelectedCountryData");
            var countryDialCode = countryData.dialCode;
            countryDialCode = "+" + countryDialCode;
            console.log(countryDialCode);
            $('.phone_code').val(countryDialCode);
        });
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 46 || charCode > 57)) {
            return false;
        }
        return true;
    }*/

</script>
<script>
    $( ".popup-id" ).each(function(index) {
        $(this).on("click", function(){
            var popupid = $(this).data('popupid');
            $('#popup_id').val(popupid);
        });
    });

</script>

<script>
    $(document).ready(function (){

        $(".into_sec").click(function(){
            var header_hight = $('header').height();
            $('html, body').animate({
                scrollTop: $("#introduction").offset().top - header_hight
            }, 500);
        });
        $(".into_second_sec").click(function(){
            var header_hight = $('header').height();
            $('html, body').animate({
                scrollTop: $("#introduction_2").offset().top - header_hight
            }, 500);
        });
        $(".tips_sec").click(function(){
            var header_hight = $('header').height();
            $('html, body').animate({
                scrollTop: $("#tips").offset().top - header_hight
            }, 500);
        });

        $(".portal-div-section").click(function(){
            var header_hight = $('header').height();
            $('html, body').animate({
                scrollTop: $("#myTabContent").offset().top - header_hight
            }, 500);
        });

        $('.call_btn').click(function(){
            $('.call_pop').toggleClass('active');
        });


    });

    $('body').on('click', '.password-show', function () {
        var $check_password = $(this).parents('.eye-icon').find('input.ckeck-password').attr('type');
        if('password' == $check_password){
            $(this).parents('.eye-icon').find('input.ckeck-password').prop('type', 'text');
        }else{
            $(this).parents('.eye-icon').find('input.ckeck-password').prop('type', 'password');
        }
    });
</script>


</body>

</html>
