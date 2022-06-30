@extends('frontview.layouts.common')

@section('headerscripts')
@stop

@section('content')

    <div class="registration-modal pb-5 pt-5 bg-black">
        <div class="container">
            <div class="row bg-wight">
                <div class="col-md-11 col-lg-8 mx-auto">
                    <!-- heading image-->
                    <div class="row d-flex justify-content-between pt-5">
                        <div class="col-md-8 col-lg-8 mx-auto pt-4">
                            <h3 class="blue-text mb-3">ANMELDUNG mit Codenummer</h3>
                            <p><strong>Bitte gib hier den 6-stelligen CODE ein:</strong></p>
                            <form id="form" action="{{action('Frontend\IndexController@sendMessageAddData')}}" method="post">
                                @csrf
                                <div class="form__group form__pincode">
                                    <input type="tel" name="pincode-1" maxlength="1" pattern="[\d]*" tabindex="1" placeholder="·" autocomplete="off">
                                    <input type="tel" name="pincode-2" maxlength="1" pattern="[\d]*" tabindex="2" placeholder="·" autocomplete="off">
                                    <input type="tel" name="pincode-3" maxlength="1" pattern="[\d]*" tabindex="3" placeholder="·" autocomplete="off">
                                    <input type="tel" name="pincode-4" maxlength="1" pattern="[\d]*" tabindex="4" placeholder="·" autocomplete="off">
                                    <input type="tel" name="pincode-5" maxlength="1" pattern="[\d]*" tabindex="5" placeholder="·" autocomplete="off">
                                    <input type="tel" name="pincode-6" maxlength="1" pattern="[\d]*" tabindex="6" placeholder="·" autocomplete="off">

                                    @php
                                        $section = session('send_sms');
                                    @endphp

                                    <input type="hidden" value="" name="code" id="code">
                                    <input type="hidden" value="" name="url" id="url">

                                    {{-- <input type="hidden" value="{{ $popup_id }}" name="popup_id" id="popup_id"> --}}

                                </div>
                                 <!-- Radio Button -->
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
                                 <!-- Radio Button Over -->
                                 <!-- Name Textbox start -->
                                <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                                    <div class="col-md-12 col-lg-6">
                                        <label>Nachname<span class="blue-text">*</span></label><br>
                                        <input type="text" required name="nachname">
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <label>Vorname<span class="blue-text">*</span></label><br>
                                        <input type="text" required name="vorname">
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between mt-3 registration-modal-input-fields">
                                    <div class="col-md-12 col-lg-6 ">
                                        <label>Geburtsdatum<span class="blue-text">*</span></label><br>
                                        <input type="date" required name="geburtsdatum">
                                    </div>
                                </div>
                                  <!-- Name Textbox over -->

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
                                        <button class="next-btn" type="submit" value="submit" name="submit" id="check_btn">SENDEN</button>
                                        <!-- <a href="#" class="next-btn" data-toggle="modal" data-target="#ThankyouModal" data-dismiss="modal">SENDEN</a> -->
                                    </div>
                                </div>

                                <div class="form__success">
                                    <p id="message_display"></p>
                                </div>
                                <!-- <div class="form__buttons">
                                    <button value="submit" name="submit" class="button button-primary" id="check_btn">Continue</button>
                                </div> -->
                            </form>
                        </div>
                        <div class="col-md-4 col-lg-4 register-page-header-image">
                            <img src="{{front_assets}}/images/register-page-image.png" class="img-fluid code-image" alt="">
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-5">
                        <small class="blue-text">schließen</small>
                        <button type="button" class="modal-close-button shadow" data-dismiss="modal">
                            X
                        </button>
                    </div>
                    <!-- heading image Over-->
                </div>
            </div>
        </div>

    </div>

@stop

@section('footerscripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mockjax@2.2.2/src/jquery.mockjax.min.js"></script> --}}

    <script src="{{front_assets}}/js/inputmask.min.js"></script>
    <script src="{{front_assets}}/js/jquery.inputmask.min.js"></script>
    <script src="{{front_assets}}/js/jquery.mockjax.min.js"></script>
    <script src="{{front_assets}}/js/anmelding.js"></script>

    <script>
        $(function () {
        $("#form").validate({
            rules: {
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
                geburtsdatum: {
                    required: true,
                },
            },
            messages: {
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
                geburtsdatum: {
                    required: "Bitte Geburtsdatum eingeben!"
                },
            }
        });
    });
</script>

@stop
