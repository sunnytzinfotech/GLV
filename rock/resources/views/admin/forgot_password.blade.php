<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Forgot Password | {!!site_name!!}</title>

        <link href="{{admin_assets}}/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{admin_assets}}/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Toastr style -->
        <link href="{{admin_assets}}/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <link href="{{admin_assets}}/css/animate.css" rel="stylesheet">
        <link href="{{admin_assets}}/css/style.css" rel="stylesheet">
        <!-- FavLogo -->
        @php
            $site_data = App\Models\SiteSetting::all()->toArray();
        @endphp
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('uploads/')}}/{!! $site_data[0]['sflogo'] !!}">
    </head>

    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <h2>{!!site_name!!}</h2>
                <h4>Forgot Password</h4>
                <h4>Enter registered Email address</h4>

                @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
                @endif
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
                @endif

                @if (\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
                @endif

                {!! Form::open(array('method' => 'POST','url' => 'admin/forgot_password', 'id' => 'login-form','class'=>'m-t')) !!}

                <div class="form-group">
                    {!! Form::email('adminemail', old('adminemail'),array('class'=>'form-control', 'placeholder' => 'Email address','autofocus','required')) !!}
                </div>

                {!! Form::submit('Reset', array('class'=>'btn btn-primary block full-width m-b')) !!}

                {!! Form::close() !!}
            </div>

            <div class="col-md-12">
                <a class="btn btn-sm btn-primary" href="{!!url('admin')!!}">Login</a>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="{{admin_assets}}/js/jquery-3.1.1.min.js"></script>
        <script src="{{admin_assets}}/js/bootstrap.min.js"></script>
    </body>
</html>