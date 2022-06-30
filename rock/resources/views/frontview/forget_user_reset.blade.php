@extends('frontview.layouts.common')

@section('headerscripts')
@stop

@section('content')
<section class="box-bg-color-pd">
    <div class="container">
        <div class="row h-100 justify-content-md-center marging-forget">
            <div class="col-sm-6 my-auto mb-6 bg-wight" style="">
                <div class="form-box box-login-padding">
                    <h3 class="login-title">Reset Password</h3>
                    <form action="{{route('resetpassword')}}" id="reset-form" method="post" autocomplete="off">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                        <input name="user_id" type="hidden" value="@if(isset($id) && !empty($id)){{$id}} @endif" />
                        <div class="form-group">
                            <input type="password" name="new_password" class="form-control" id="new_password">
                            <label class="font-italic">new-password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" data-rule-equalTo="#new_password">
                            <label class="font-italic">Confirm Password</label>
                        </div>
                        <div class="text-center mt2">
                            <button class="next-btn upper">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@stop

@section('footerscripts')
@stop
