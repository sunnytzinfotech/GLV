<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title') | {!!site_name!!}</title>

        <link href="{{admin_assets}}/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{admin_assets}}/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- FavLogo -->
        @php
            $site_data = App\Models\SiteSetting::all()->toArray();
        @endphp
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('uploads/')}}/{!! $site_data[0]['sflogo'] !!}">

        <!-- Toastr style -->
        <link href="{{admin_assets}}/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="{{admin_assets}}/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <link rel="stylesheet" href="{{admin_assets}}/js/plugins/froala_editor/css/froala_editor.pkgd.min.css">
        <link rel="stylesheet" href="{{admin_assets}}/js/plugins/froala_editor/css/froala_style.min.css">
        <link rel="stylesheet" href="{{admin_assets}}/js/plugins/froala_editor/css/plugins/image.min.css">
        <link rel="stylesheet" href="{{admin_assets}}/js/plugins/froala_editor/css/plugins/draggable.min.css">
        <link rel="stylesheet" href="{{admin_assets}}/js/plugins/froala_editor/css/plugins/fullscreen.min.css">
        <link href="{{admin_assets}}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="{{admin_assets}}/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

        <link href="{{admin_assets}}/css/animate.css" rel="stylesheet">
        <link href="{{admin_assets}}/css/style.css" rel="stylesheet">
        <link href="{{admin_assets}}/css/custom.css" rel="stylesheet">
        @yield('headerscripts')
    </head>
    <body>
        <div id="wrapper">
            <!-- sidebar start -->
            @include('admin.layouts.sidebar')
            <!-- sidebar end -->

            <div id="page-wrapper" class="gray-bg">
                <!-- header start -->
                @include('admin.layouts.header')
                <!-- header end -->

                @yield('content')

                <!-- header start -->
                @include('admin.layouts.footer')
                <!-- header end -->
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="{{admin_assets}}/js/jquery-3.1.1.min.js"></script>
        <script src="{{admin_assets}}/js/bootstrap.min.js"></script>
        <script src="{{admin_assets}}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="{{admin_assets}}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <script type="text/javascript" src="{{admin_assets}}/js/plugins/froala_editor/js/froala_editor.pkgd.min.js"></script>
        <!-- Custom and plugin javascript -->
        <script src="{{admin_assets}}/js/inspinia.js"></script>
        <script src="{{admin_assets}}/js/plugins/dataTables/datatables.min.js"></script>
        <!-- Toastr -->
        <script src="{{admin_assets}}/js/plugins/toastr/toastr.min.js"></script>
        <script src="{{admin_assets}}/js/plugins/sweetalert/sweetalert.min.js"></script>

        @yield('footerscripts')
    </body>
    <script>
$(document).ready(function () {
    var uploadurl = "{!!url('admin/uploadimage')!!}";
    var deleteurl = "{!!url('admin/deleteimage')!!}";

    var token = "{{ csrf_token() }}";

    $('.tzeditor').froalaEditor({
        height: 250,
        quickInsertTags: [''],
        imageUploadParam: 'editor_img',
        imageUploadURL: uploadurl,
        imageUploadParams: {_token: token},
        imageUploadMethod: 'POST',
        imageMaxSize: 300000,
        imageAllowedTypes: ['jpeg', 'jpg', 'png'],
        toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
            '|', 'fontFamily', 'fontSize', 'color', 'clearFormatting',
            '|', '-', 'paragraphFormat', 'lineHeight',
            'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote'
                    , '|', 'insertLink', 'insertImage', 'insertTable', '-',
            'insertHR', 'selectAll', 'help', 'html', 'fullscreen', '|', 'undo', 'redo'],
    }).on('froalaEditor.image.removed', function (e, editor, $img, response) {
        var imgname = $img.attr('data-name');
        $.ajax({
            method: "POST",
            url: deleteurl,
            data: {
                src: imgname,
                _token: token
            }
        })
    }).on('froalaEditor.image.uploaded', function (e, editor, response) {
        var myJSON = JSON.parse(response);
    });
});
    </script>
</html>
