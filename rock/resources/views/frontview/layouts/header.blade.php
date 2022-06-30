<!-- Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg main_header navbar-fixed-top">
        <div class="container-fluid pr-60">
            <a class="main_logo_outter" href="{{ route("home_page")  }}">
                <img src="{{URL::asset('uploads/')}}/{!! $site_data[0]['slogo'] !!}" class="img-fluid main_logo mt-12">
            </a>
            <button class="navbar-toggler" type="button" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" onclick="openNav()"></span>
            </button>
            <div class="navbar-collapse" id="navbarResponsive">
                <div class="btnclose navbar-toggler">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                </div>
                <?php
                    $value = Auth::user();
                ?>
                <ul class="navbar-nav ml-auto">
                @if(isset($value) && !empty($value))
                @else
                    <li class="nav-item">
                        <a class="nav-link into_sec" href="javascript:void(0)" >Darum Tippgeber<br> werden
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link into_second_sec" href="javascript:void(0)">So einfach geht‘s
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('faq')}}">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">Kontakt</a>
                    </li>
                    {{-- <li class="nav-item ml-20 mr-11 mobile-none">
                        <a href="javascript:void(0);" class="search_btn nav-link" data-toggle="tooltip" title=""
                           data-placement="left" data-original-title="Search">
                            <img src="{{front_assets}}/images/search.png" class="img-search">
                        </a>
                        <div class="search_pop" style="display: none;">
                            <form action="#" method="get" role="search" class="search">
                                <input type="text" name="q" value="" placeholder="Search">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </li> --}}

                    @if(isset($value) && !empty($value))
                        <li>
                            <div class="dropdown">
                                <a class="nav-link blue-text" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {!! $value['user_name'] !!} {!! $value['last_name'] !!}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    {{-- <a class="dropdown-item nav-link" href="javascript:void(0);">Kunden/Tippnehmer</a> --}}
                                    {{--<a class="dropdown-item nav-link" href="javascript:void(0);">Kundenverträge</a> --}}
                                    <a class="dropdown-item nav-link {{Request::is('deine')? 'active' : '' }}" href="{{ route('deine') }}">Persönliche Daten</a>
                                    {{-- <a class="dropdown-item nav-link" href="javascript:void(0);">Briefkasten</a> --}}
                                    <div class="divider"></div>
                                    <a class="dropdown-item nav-link" href="{!!url('/logout')!!}" id="login_header" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Ausloggen</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>

                    @else
                        <!-- <li class="nav-item ml-20 mr-11">
                            <a href="javascript:void(0);" class="register_btn nav-link" id="" data-toggle="modal"
                               data-target="#RegisterModal">REGISTER</a>
                        </li> -->
                        <li class="nav-item ml-20 mr-11">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="nav-link" id="login_header">
                                <i class='fa fa-user' style='font-size:32px;color:green'></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

</header>
<!-- Header Over-->

<!-- sticky icon -->
<ul class="list-unstyled sticky-icon">
    <li class="list-item">
        <a href="javascript:void(0);" class="call_btn" >
            <i class="fa fa-phone" aria-hidden="true"></i>
        </a>
        <a href="tel:05151981460" class="call_pop" ><span class="call_span" >05151 98 146-0</span><span class="call_time" >Mo. - Fr. 8:00 -17:00 Uhr</span></a>
    </li>
    <li class="list-item">
        <a href="mailto:info@glv-makler.de">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
        </a>
    </li>
</ul>
<!-- sticky icon Over-->
