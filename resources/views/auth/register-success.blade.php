@extends('layouts.app',['vals'=>true])
@php
    $titulo=['Solicitud de Inscripción Correcta!','Ya existe la solicitud!','Ya es expositor!'];
    $contenido=['Muchas gracias por su solicitud, un responsable del Departamento Comercial de FEICOBOL lo contactará para los siguientes pasos del registro.','Ya existe una solicitud realizada por su empresa, por favor revise los datos','La empresa ya fué aprobada para participar en la Reactiva Bolivia 2020'];
@endphp
@section('content')
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="title_text title_text2 ">
                            <h3>{{$titulo[$tipo]}}</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <span style="font-size:large;text-align:justify">{{$contenido[$tipo]}}<br>
                                        En caso de consultas o dudas, puede llamar a los siguientes números o escribir a los correos electrónicos:<br><br><ul><li>72207063 <a style="color:white" href="mailto:aflores@feicobol.com.bo"> aflores@feicobol.com.bo</a> Andrea Flores</li><li>72206073 <a href="mailto:jkent@feicobol.com.bo" style="color:white"> jkent@feicobol.com.bo</a> Juan Kent</li><li>72241462 <a style="color:white" href="mailto:parze@feicobol.com.bo"> parze@feicobol.com.bo</a> Pamela Arze</li></ul><br></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection