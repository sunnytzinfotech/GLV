@extends('frontview.layouts.common')

@section('headerscripts')
@stop

@section('content')

    <div class="registration-modal pb-5 pt-5 bg-black frame">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 mx-auto">
                    <div id="Iframe-Master-CC-and-Rs" class="center-block-horiz">
                        <div class="responsive-wrapper responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto;">
                            @if(isset($result['btn_iframe']) && !empty($result['btn_iframe']))
                                {!! $result['btn_iframe'] !!}
                            @endif
                        </div>
                    </div>
                    <div class="display-none" id="user_name">{!! $user_data['user_name'] !!}</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footerscripts')

    <script>

        $(document).ready(function(){
            var iframeSrc = $('iframe').attr('src');

            var name = "";
            var user_name = "";

            @if(isset($result['g_btn_url']) && !empty($result['g_btn_url']))
                name = "{!! $result['g_btn_url'] !!}";
            @endif

            @if(isset($user_data['user_name']) && !empty($user_data['user_name']))
                user_name = "{!! $user_data['user_name'] !!}";
            @endif

            var iframe_url = name +'&subid=' +user_name;

            $('iframe').attr('src', iframe_url);

        });

    </script>
@stop
