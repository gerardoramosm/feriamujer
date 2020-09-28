<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png?1') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css?') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css?1') }}">
    @if($vals)
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
    @endif
    <!-- <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"> -->
    @yield('head_scripts')
</head>
<body>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area" >
                <div class="container-fluid p-0">
                    <div class="row align-items-center justify-content-between no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="/">
                                    <img src="{{asset('img/logo-mini_.png?1')}}" alt="{{ config('app.name', 'Laravel') }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ url('/el-evento') }}">La Feria </a></li>
                                        <!--<li><a href="#">El evento <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="{{ url('/el-evento') }}">La Feria </a></li>
<!--                                                <li><a href="{{ url('/organizadores') }}">Organizadores </a></li>
                                                <li><a href="{{ url('/actividades-paralelas') }}">Actividades Paralelas </a></li>
                                            </ul>
                                        </li>-->
                                        <!-- <li><a href="#">Quiero Participar <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="{{ url('/requisitos') }}">Requisitos</a></li>
                                                <li><a href="{{ url('/beneficios') }}">Beneficios</a></li>
                                                <li><a href="{{ url('/como-participar') }}">Cómo participar</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="{{url('quiero-participar')}}">Quiero Participar</a></li>
                                        <!--<li><a href="Venue.html">Venue</a></li>-->
                                        @if (Route::has('login'))
                                        @auth
                                            <li><a class="boxed-btn" href="{{ url('/home') }}">Ingreso<br>Expositores</a></li>
                                        @else
                                            <li><a class="boxed-btn" href="{{ route('login') }}">Ingreso<br>Expositores</a></li>
                                            @if(date('Y-m-d H:i:s')<='2020-09-06 00:00:00')
                                            <li><a class="boxed-btn" href="{{ route('register') }}">Registro<br>Expositores</a></li>
                                            @endif
                                            @if(date('Y-m-d H:i')>='2020-09-25 10:30' && date('Y-m-d H:i')<='2020-09-28 00:00')
                                            <li><a class="boxed-btn" href="{{ route('visita') }}">Visita<br>el evento</a></li>
                                            @endif
                                        @endauth
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2"></div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <div id="app">


        @yield('content')
        
    </div>
    <!-- footer_start -->
    <footer class="footer">
<!--        <div class="circle_ball d-none d-lg-block">
            <img src="img/banner/footer_ball.png" style="height: 50%" alt="">
        </div>-->
            <div class="footer_top" style="padding:0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-lg-4">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Redes Sociales
                                </h3>
                                <ul>
                                    <li><a target="_blank" href="https://www.facebook.com/feicobol">Facebook</a></li>
                                    <li><a target="_blank" href="http://www.twitter.com/Feicoboloficial">Twitter</a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/feicobol_oficial/">Instagram</a></li>
                                    <li><a target="_blank" href="http://www.youtube.com/channel/UC9MEKWh-GR1slRtbEVByeRg">Youtube</a></li>
                                </ul>
    
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-lg-4" style="text-align: center">
                            <div class="footer_widget">
                                <img src="{{ asset('img/logoF.jpeg') }}" style="width: 30%;padding-top:10px">
                                <img src="{{ asset('img/logoM.jpeg') }}" style="width: 30%;padding-top:10px">
                            <!--    <h3 class="footer_title">
                                        Links
                                </h3>
                                <ul>
                                    <li><a target="_blank" href="schedule.html">Schedule</a></li>
                                    <li><a target="_blank" href="speakers.html">Speakers</a></li>
                                    <li><a target="_blank" href="contact.html">Contact</a></li>
                                </ul>-->
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-lg-4">
                            <div class="footer_widget copy-right_text">
                                <h3 class="footer_title">
                                    Contactos
                                </h3>
                                <h3 class="footer_title">FEICOBOL</h2>
                                <p class="copy_right">
                                    <a class="" href="mailto:feicobol@feicobol.com.bo">feicobol@feicobol.com.bo</a><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="copy_right text-center">
                                <a href="https://www.feicobol.com.bo">FEICOBOL</a> &copy;<script>document.write(new Date().getFullYear());</script> | Powered by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <!-- footer_end -->

    <!-- Scripts -->
    <!-- JS here -->
    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/ajax-form.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/scrollIt.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <!--contact js-->
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>

    <script src="{{ asset('js/main.js?2') }}"></script>
@yield('scripts')
</body>
</html>