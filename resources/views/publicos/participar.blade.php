@extends('layouts.app',['vals'=>true])

@section('content')
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="title_text title_text2 ">
                            <h3>Cómo Participar</h3>
                            <span style="color:white">Haz clic en los pasos a seguir para poder ser expositor de la Reactiva Bolivia 2020</span>
                        </div>
                    </div>
                    <div class="col-xl col-lg">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <img data-cfsrc="{{asset('img/barnd/info.png')}}" alt="" src="{{asset('img/barnd/info.png')}}"> Regístrate como expositor
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="">
                                    <div class="card-body" style="text-align: justify">
                                    Haz clic en el botón de abajo y llena los datos de la empresa: Nombre de la empresa, NIT, Nombre de la persona de contacto, Teléfono o Celular de contacto, Productos que expondrás, Correo Electrónico de contacto y contraseña para la plataforma y lee y acepta los Términos y Condiciones.<br>
                                    <a href="{{route('register')}}" class="boxed-btn-red">Regístrate Aquí </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <img data-cfsrc="{{asset('img/barnd/info.png')}}" alt="" src="{{asset('img/barnd/info.png')}}"> Espera el contacto
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                                <div class="card-body" style="text-align: justify">
                                El Departamento Comercial de FEICOBOL te contactará para confirmar tu participación y habilitar tu cuenta en la Plataforma, asimismo recibirás un Correo Electrónico de confirmación de la aprobación y podrás ingresar con tu cuenta al botón de abajo.<br>
                                <a href="{{route('login')}}" class="boxed-btn-red">Ingresa a la plataforma aquí </a>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="heading_4">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">
                                    <img data-cfsrc="{{asset('img/barnd/info.png')}}" alt="" src="{{asset('img/barnd/info.png')}}"> Paga y Prepara el Stand
                                </button>
                                </h5>
                            </div>
                            <div id="collapse_4" class="collapse" aria-labelledby="heading_4" data-parent="#accordion" style="">
                                <div class="card-body" style="text-align: justify">
                                    Envía el comprobante de pago por la plataforma y una vez aprobado, podrás agregar información de la empresa, productos y/o servicios, ofertas especiales, datos de contacto, logotipo, fotos, video de su empresa o productos (si tiene).
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="countDOwn_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <!--    <div class="single_date">
                        <i class="ti-location-pin"></i>
                        <span>City Hall, New York City</span>
                    </div>-->
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span>17 al 23 de Septiembre 2020</span>
                    </div>
                </div>
                <div class="col-xl-5 col-md-12 col-lg-5">
                    <span id="clock"></span>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection