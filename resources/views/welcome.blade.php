@extends('layouts.app',['vals'=>false])
@section('content')
<!-- slider_area_start -->
<img src="{{asset('img/imagen-web.jpg')}}" style="width:100%">
<div class="slider_area slider_bg_1">
    <div class="row">
        <div class="col-xl-4 col-md-4 col-lg-4 single_date">
            <i class="ti-alarm-clock"></i>
            <span>17 al 23 de Septiembre 2020</span>
        </div>
        <a href="{{ url('/la-feria') }}" class="col-xl-2 col-md-2 col-lg-2 boxed-btn-red">Qué es Reactiva Bolivia?</a>
        @if(date('Y-m-d H:i:s')<='2020-09-15 23:59:59')
        <a href="{{ url('/quiero-participar') }}" class="col-xl-2 col-md-2 col-lg-2 boxed-btn-red">Participa como expositor</a>
        @endif
        @if(date('Y-m-d H:i')>='2020-09-17 10:30' && date('Y-m-d H:i')<='2020-09-24 00:00')
        <a href="{{ url('/visita') }}" class="col-xl-4 col-md-4 col-lg-4 boxed-btn-red">Visita la Feria</a>
        @endif
        <div class="col-xl-4 col-md-4 col-lg-4">
            <span id="clock"></span>
        </div>
    
    </div>


<!--    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <h1 class="opcity_text d-none d-lg-block">REACTIVA</h1>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="title_text">
                            <h3>MiPyME Digital 2020</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="countDOwn_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <!--    <div class="single_date">
                        <i class="ti-location-pin"></i>
                        <span>City Hall, New York City</span>
                    </div>-->
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3" style="display: none">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span>27 al 31 de Agosto 2020</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- about_area_start -->
<!--<div class="about_area">
    <div class="shape-1 d-none d-xl-block">
        <img src="img/about/shap1.png" alt="">
    </div>
    <div class="shape-2 d-none d-xl-block">
        <img src="img/about/shap2.png" alt="">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6">
                <div class="about_thumb">
                    <img src="img/about/about.png" alt="">
                </div>
            </div>
            <div class="col-xl-5 offset-xl-1 col-md-6">
                <div class="about_info">
                    <div class="section_title">
                        <span class="sub_heading">El evento</span>
                        <h3>El punto de encuentro <br>
                            para actuales y futuros <br>
                            Proveedores de ENDE</h3>
                    </div>
                    <p>En su primera versión, ENDE Conecta será el primer evento digital de interconexión entre ENDE y sus filiales con las empresas interesadas en proveer productos y servicios.</p>
                    <a href="{{url('el-evento')}}" class="boxed-btn-red">Ver Más</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about_area_end -->

<!-- speakers_start --><!--
<div class="speakers_area">
    <h1 class="horizontal_text d-none d-lg-block">
        Speakers
    </h1>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="serction_title_large mb-95">
                    <h3>
                        Speakers
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 col-md-6">
                <div class="single_speaker">
                    <div class="speaker_thumb">
                        <img src="img/speakers/1.png" alt="">
                        <div class="hover_overlay">
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="speaker_name text-center">
                        <h3>Jonson Miller</h3>
                        <p>Creative Director</p>
                    </div>
                </div>
                <div class="single_speaker">
                    <div class="speaker_thumb">
                        <img src="img/speakers/3.png" alt="">
                        <div class="hover_overlay">
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="speaker_name text-center">
                        <h3>Albert Jackey</h3>
                        <p>Product Designer</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 offset-xl-2 col-md-6">
                <div class="single_speaker">
                    <div class="speaker_thumb">
                        <img src="img/speakers/2.png" alt="">
                        <div class="hover_overlay">
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="speaker_name text-center">
                        <h3>Marked Macau</h3>
                        <p>UI/UX Designer</p>
                    </div>
                </div>
                <div class="single_speaker">
                    <div class="speaker_thumb">
                        <img src="img/speakers/1.png" alt="">
                        <div class="hover_overlay">
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="speaker_name text-center">
                        <h3>Kelvin Cooper</h3>
                        <p>Art Director</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- speakers_end-->

<!-- event_area_start --><!--
<div class="event_area">
    <h1 class="vr_text d-none d-lg-block">Cronograma del evento</h1>
    <div class="container">
        <div class="single_line">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="date">
                        <h3>02 Julio 2020</h3>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9">
                    <div class="single_speaker">
                        <img src="img/speakers/seaker1.png" alt="">
                        <div class="speaker-name">
                            <div class="heading d-flex justify-content-between align-items-center">
                                <span>Jonson Miller</span>
                                <div class="time">
                                    10-11 am
                                </div>
                            </div>
                            <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let
                                god moving.
                                Moving in fourth air night bring upon you’re it beast let you dominion </p>
                        </div>
                    </div>
                    <div class="single_speaker">
                        <img src="img/speakers/seaker2.png" alt="">
                        <div class="speaker-name">
                            <div class="heading d-flex justify-content-between align-items-center">
                                <span>Albert Jackey</span>
                                <div class="time">
                                    12-1.00 pm
                                </div>
                            </div>
                            <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let
                                god moving.
                                Moving in fourth air night bring upon you’re it beast let you dominion </p>
                        </div>
                    </div>
                    <div class="single_speaker">
                        <img src="img/speakers/seaker3.png" alt="">
                        <div class="speaker-name">
                            <div class="heading d-flex justify-content-between align-items-center">
                                <span>Alvi Nourin</span>
                                <div class="time">
                                    2.30-4.00 pm
                                </div>
                            </div>
                            <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let
                                god moving.
                                Moving in fourth air night bring upon you’re it beast let you dominion </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="double_line">
            <div class="row">
            <div class="col-xl-3 col-lg-3">
                <div class="date">
                    <h3>03 Julio 2020</h3>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="single_speaker">
                    <img src="img/speakers/seaker4.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Marked Macau</span>
                            <div class="time">
                                10-11 am
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
                <div class="single_speaker">
                    <img src="img/speakers/seaker5.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Jonson Miller</span>
                            <div class="time">
                                12-1.00 pm
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
                <div class="single_speaker">
                    <img src="img/speakers/seaker6.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Jonson Miller</span>
                            <div class="time">
                                2.30-4.00 pm
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3">
                <div class="date">
                    <h3>04 Julio 2020</h3>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="single_speaker">
                    <img src="img/speakers/seaker4.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Marked Macau</span>
                            <div class="time">
                                10-11 am
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
                <div class="single_speaker">
                    <img src="img/speakers/seaker5.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Jonson Miller</span>
                            <div class="time">
                                12-1.00 pm
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
                <div class="single_speaker">
                    <img src="img/speakers/seaker6.png" alt="">
                    <div class="speaker-name">
                        <div class="heading d-flex justify-content-between align-items-center">
                            <span>Jonson Miller</span>
                            <div class="time">
                                2.30-4.00 pm
                            </div>
                        </div>
                        <p>Our set he for firmament morning sixth subdue darkness creeping gathered divide our let
                            god moving.
                            Moving in fourth air night bring upon you’re it beast let you dominion </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- event_area_end -->


<!-- resister_book_start -->
<!--<div class="resister_book resister_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="resister_text text-center">
                    @guest
                    <h3>Regístrate ahora para <br>
                        poder participar</h3>
                    <a href="{{url('/register')}}" class="boxed-btn-white">Formulario de Registro </a>
                    @else
                    <h3>Ya estás logueado como <br>
                        {{Auth::user()->empresa}}</h3>
                    <a href="{{url('/home')}}" class="boxed-btn-white">Ingresa a la feria </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- resister_book_end -->

<!-- brand_area_start --><!--
<div class="brand_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="serction_title_large mb-95">
                    <h3>
                        Empresas Demandantes
                    </h3>
                </div>
                <div class="brand_active owl-carousel">
                    <div class="single_brand text-center">
                        <img src="img/barnd/1.png" alt="">
                    </div>
                    <div class="single_brand text-center">
                        <img src="img/barnd/2.png" alt="">
                    </div>
                    <div class="single_brand text-center">
                        <img src="img/barnd/3.png" alt="">
                    </div>
                    <div class="single_brand text-center">
                        <img src="img/barnd/4.png" alt="">
                    </div>
                    <div class="single_brand text-center">
                        <img src="img/barnd/5.png" alt="">
                    </div>
                    <div class="single_brand text-center">
                        <img src="img/barnd/6.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- brand_area_end -->

<!-- faq_area_Start -->
<!--<div class="faq_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="serction_title_large mb-95">
                    <h3>
                        Frequently Ask
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                    <img src="img/barnd/info.png" alt=""> Is WordPress hosting worth it?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion"
                            style="">
                            <div class="card-body">
                                Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let god moving. Moving in fourth air night bring upon
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <img src="img/barnd/info.png" alt="">What are the advantages <span>of WordPress
                                        hosting over shared?</span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion" style="">
                            <div class="card-body">
                                Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let god moving. Moving in fourth air night bring upon
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    <img src="img/barnd/info.png" alt=""> Where the Venue?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion" style="">
                            <div class="card-body">
                                Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let god moving. Moving in fourth air night bring upon
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="heading_4">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">
                                    <img src="img/barnd/info.png" alt=""> How can I attend <span>the Event from
                                        Asia?</span>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse_4" class="collapse" aria-labelledby="heading_4" data-parent="#accordion"
                            style="">
                            <div class="card-body">
                                Our set he for firmament morning sixth subdue darkness creeping gathered divide our
                                let god moving. Moving in fourth air night bring upon
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- faq_area_end -->
@endsection