@extends('layouts.appFV',['menu'=>false,'slider'=>false,'link'=>$link])
@section('stand')
<section class="">
    <div class="iframe-container">
        <svg style="display: inline-block;
        position: absolute;
        top: 0px; left: 0px;" version="2" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 1280 505" preserveAspectRatio="xMinYMin meet" >
        <image width="1280" height="505" xlink:href="{{asset('img/standF-'.$st->tipo.'.jpg?2')}}"></image>
        @php 
            $coords=array(
                350=>array(530,161,112,49,464,220,212,93,886,42,252,413,344,363,63,63,407,363,253,63,657,162,51,51,0,0,0,0,724,162,51,51),
                500=>array(908,216,119,66,500,199,371,116,126,133,188,266,847,348,162,71,1009,348,71,71,880,76,85,85,956,76,85,85,722,323,103,66),
                700=>array(590,218,130,61,539,80,166,92,143,100,199,299,782,369,54,54,836,369,261,54,735,82,84,94,819,82,84,94,927,82,168,93));
        @endphp
        <a href="#" data-toggle="modal" data-target="#nosotros" >
            <rect x="{{$coords[$st->tipo][0]}}" y="{{$coords[$st->tipo][1]}}" width="{{$coords[$st->tipo][2]}}" height="{{$coords[$st->tipo][3]}}" fill="#fff" opacity="0" >
                <title>Clic aquí para ver información de la empresa</title>
            </rect>
            @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$st->id_empresa.'_1.jpg'))
                <image x="{{$coords[$st->tipo][0]}}" y="{{$coords[$st->tipo][1]}}" width="{{$coords[$st->tipo][2]}}" height="{{$coords[$st->tipo][3]}}" xlink:href="https://virtual.feicobol.com.bo/img/stand_images/{{$st->id_empresa}}_1.jpg?{{date('Y-m-d H')}}"></image>
            @else
                <image x="{{$coords[$st->tipo][0]}}" y="{{$coords[$st->tipo][1]}}" width="{{$coords[$st->tipo][2]}}" height="{{$coords[$st->tipo][3]}}" xlink:href="https://reactivaproductiva.feicobol.com/img/modif_stands/acerca.jpg"></image>
            @endif
        </a>
        <a href="#" data-toggle="modal" data-target="#productos" >
            <rect x="{{$coords[$st->tipo][4]}}" y="{{$coords[$st->tipo][5]}}" width="{{$coords[$st->tipo][6]}}" height="{{$coords[$st->tipo][7]}}" fill="#fff" opacity="0" ><title>Clic aquí para ver los productos/servicios de la empresa</title>
            </rect>
            @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$st->id_empresa.'_2.jpg'))
                <image x="{{$coords[$st->tipo][4]}}" y="{{$coords[$st->tipo][5]}}" width="{{$coords[$st->tipo][6]}}" height="{{$coords[$st->tipo][7]}}" xlink:href="https://virtual.feicobol.com.bo/img/stand_images/{{$st->id_empresa}}_2.jpg?{{date('Y-m-d H')}}"></image>
            @else
                <image x="{{$coords[$st->tipo][4]}}" y="{{$coords[$st->tipo][5]}}" width="{{$coords[$st->tipo][6]}}" height="{{$coords[$st->tipo][7]}}" xlink:href="https://reactivaproductiva.feicobol.com/img/modif_stands/productos.jpg"></image>
            @endif
        </a>
        @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$st->id_empresa.'_3.jpg'))
            <image x="{{$coords[$st->tipo][8]}}" y="{{$coords[$st->tipo][9]}}" width="{{$coords[$st->tipo][10]}}" height="{{$coords[$st->tipo][11]}}" xlink:href="https://virtual.feicobol.com.bo/img/stand_images/{{$st->id_empresa}}_3.jpg?{{date('Y-m-d H:i:s')}}"></image>
        @else
            <image x="{{$coords[$st->tipo][8]}}" y="{{$coords[$st->tipo][9]}}" width="{{$coords[$st->tipo][10]}}" height="{{$coords[$st->tipo][11]}}" xlink:href="https://reactivaproductiva.feicobol.com/img/logo-colores.png"></image>
        @endif
        @if(file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$st->logo.'.jpg'))
            <image x="{{$coords[$st->tipo][12]}}" y="{{$coords[$st->tipo][13]}}" width="{{$coords[$st->tipo][14]+$coords[$st->tipo][18]}}" height="{{$coords[$st->tipo][15]}}" xlink:href="https://expositores.feicobol.com.bo/images/logos/{{$st->id_empresa}}.jpg?{{date('Y-m-d H:i:s')}}"></image>
        @else
            <foreignObject x="{{$coords[$st->tipo][12]}}" y="{{$coords[$st->tipo][13]}}" width="{{$coords[$st->tipo][14]+$coords[$st->tipo][18]}}px" height="{{$coords[$st->tipo][19]}}px">
                <h2 style="text-align: center;font-size:x-large">{{$st->nombre_empresa}}</h2>
            </foreignObject>
        @endif        
        @if($st->tipo==350)
            @php $limite=1; @endphp
        @else
            @php $limite=2; @endphp
        @endif
        @php $conta=0; @endphp
        @if($st->fb!='')
            <foreignObject style="text-align: center" x="{{$coords[$st->tipo][20]}}" y="{{$coords[$st->tipo][21]}}" width="{{$coords[$st->tipo][22]}}px" height="{{$coords[$st->tipo][23]}}px">
                <a href="{{$st->fb}}" class="fa fa-facebook" target="_blank"></a>
            </foreignObject>
            @php $conta++; @endphp
        @endif
        @if($st->ig!='')
            @if ($conta<$limite)
                @if($limite==0)
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][20]}}" y="{{$coords[$st->tipo][21]}}" width="{{$coords[$st->tipo][22]}}px" height="{{$coords[$st->tipo][23]}}px">
                        <a href="{{$st->ig}}" class="fa fa-instagram" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @else
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][24]}}" y="{{$coords[$st->tipo][25]}}" width="{{$coords[$st->tipo][26]}}px" height="{{$coords[$st->tipo][27]}}px">
                        <a href="{{$st->ig}}" class="fa fa-instagram" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @endif
            @endif
        @endif
        @if($st->tw!='')
            @if ($conta<$limite)
                @if($limite==0)
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][20]}}" y="{{$coords[$st->tipo][21]}}" width="{{$coords[$st->tipo][22]}}px" height="{{$coords[$st->tipo][23]}}px">
                        <a href="{{$st->tw}}" class="fa fa-twitter" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @else
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][24]}}" y="{{$coords[$st->tipo][25]}}" width="{{$coords[$st->tipo][26]}}px" height="{{$coords[$st->tipo][27]}}px">
                        <a href="{{$st->tw}}" class="fa fa-twitter" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @endif
            @endif
        @endif
        @if($st->yt!='')
            @if ($conta<$limite)
                @if($limite==0)
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][20]}}" y="{{$coords[$st->tipo][21]}}" width="{{$coords[$st->tipo][22]}}px" height="{{$coords[$st->tipo][23]}}px">
                        <a href="{{$st->yt}}" class="fa fa-youtube" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @else
                    <foreignObject style="text-align: center" x="{{$coords[$st->tipo][24]}}" y="{{$coords[$st->tipo][25]}}" width="{{$coords[$st->tipo][26]}}px" height="{{$coords[$st->tipo][27]}}px">
                        <a href="{{$st->yt}}" class="fa fa-youtube" target="_blank"></a>
                    </foreignObject>
                    @php $conta++; @endphp
                @endif
            @endif
        @endif
        @if($ejecutivos->count()>0)
            <a href="#" data-toggle="modal" data-target="#contactos" >
                <image x="{{$coords[$st->tipo][28]}}" y="{{$coords[$st->tipo][29]}}" width="{{$coords[$st->tipo][30]}}" height="{{$coords[$st->tipo][31]}}" xlink:href="{{asset('img/modif_stands/contactos.jpg')}}"></image>
                <rect x="{{$coords[$st->tipo][28]}}" y="{{$coords[$st->tipo][29]}}" width="{{$coords[$st->tipo][30]}}" height="{{$coords[$st->tipo][31]}}" fill="#fff" opacity="0" ><title>Clic aquí para contactar con los ejecutivos disponibles y/o iniciar el videochat</title></rect>
            </a>
        @endif
    </svg>
</div>
<div id="nosotros" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @if(file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$st->logo.'.jpg'))
                <div class="col-3" style="text-align: center">
                <img src="https://expositores.feicobol.com.bo/images/logos/{{$st->logo}}.jpg?{{date('Y-m-d H:i:s')}}" width="100%"><br>
                    <div class="row">
                @if($st->fb!='')
                <a href="{{$st->fb}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-facebook"></a><!--{{$st->fb}}<br>-->
                @endif
                @if($st->yt!='')
                <a href="{{$st->yt}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-youtube"></a><!--{{$st->fb}}<br>-->
                @endif
                @if($st->tw!='')
                <a href="{{$st->tw}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-twitter"></a><!--{{$st->fb}}<br>-->
                @endif
                @if($st->ig!='')
                <a href="{{$st->ig}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-instagram"></a><!--{{$st->ig}}<br>-->
                @endif
                @if($st->wpp!='')
                <a href="https://api.whatsapp.com/send?text=Quiero%20mas%20informacion&phone=591{{$st->wpp}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-whatsapp"></a><!--{{$st->wpp}}<br>-->
                @endif
                @if($st->email_representante!='')
                <a style="padding:10px;font-size:20px" href="mailto:{{$st->email_representante}}" target="_blank" class="fa fa-envelope"></a><!--{{$st->email_representante}}<br>-->
                @endif
                @if($st->telefono_responsable!='')
                    @handheld
                    <a href="tel:{{$st->telefono_responsable}}" style="padding:10px;font-size:20px" target="_blank" class="fa fa-phone"></a><!--{{$st->telefono_responsable}}-->
                    @elsehandheld
                    <a style="padding:10px;font-size:20px" href="#" onclick="mostrarfono()" class="fa fa-phone"></a>
                    <span class="text" style="display: none" id="fono_show">
                    {{$st->telefono_responsable}}</span>
                    @endhandheld
                @endif
                </div></div>
                @endif
                <div class="col-9">
                    <h4 style="display: contents">{{$st->nombre_stand!='' ? $st->nombre_stand : $st->nombre_empresa }}</h4><br>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding:0">&times;</button>
                    {{$st->descripcion}}
                    <div class="row">
                        @if($st->video!='')
                        <iframe class="col-md-6" style="width: 50%" height="@mobile 150px @elsedesktop 150px @endmobile" src="{{$st->video}}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                        @if($st->video2!='')
                        <iframe class="col-md-6" style="width: 50%" height="@mobile 150px @elsedesktop 150px @endmobile" src="{{$st->video2}}" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <h4>Donde estamos?</h4>
                    <div style="width: 100%; height: 300px" id="sucursales-map"></div>
                </div>
                <div class="col-md-6">
                <h4>Puedes hacer clic en los botones verdes de las sucursales para verlas en el mapa!</h4>
                <table class="table">
                    <tr>
                        <th>
                            Dirección
                        </th>
                        <th>
                            Teléfono
                        </th>
                        <th>
                            Características
                        </th>
                    </tr>
                    @if(!isset($stands))
                    <tr>
                        <td><button type="button" class="btn btn-success" onclick="ver('{{$st->lat}}','{{$st->lon}}')"><ion-icon name="locate-outline"></ion-icon></button>
                            {{$st->direccion}}</td>
                        <td>{{$st->telefono}}</td>
                        <td>Oficina Principal</td>
                    </tr>
                    @endif
                    @foreach($sucs as $s)
                    <tr>
                        <td><button type="button" class="btn btn-success" onclick="ver('{{$s->lat}}','{{$s->lon}}')"><ion-icon name="locate-outline"></ion-icon></button>
                            {{$s->address}}</td>
                        <td>{!!$s->telefono!!}</td>
                        <td>{!!$s->caracteristicas!!}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="productos" class="modal fade" style="z-index: 1041">
    <div class="modal-dialog @if(count($productos)>4) modal-xl @elseif(count($productos)>2) modal-lg @endif">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Nuestros Productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @foreach($productos as $i=>$p)
                @if($i%4==0)
                    <div class="card-deck">
                @endif
                <div class="card">
                    @php $fots=explode(";",$p->fotos);
                        $cantf=count($fots);
                    @endphp
                    <div class="row" style="margin:0px !important">
                        @foreach($fots as $j=>$f)
                        <a href="https://virtual.feicobol.com.bo/img/productos/{{$f}}?{{date('Y-m-d H:i:s')}}"  class="image-popup-no-margins" style="width: {{100/$cantf}}%;align-self:center">
                            <img class="card-img-top" style="width:100%" src="https://virtual.feicobol.com.bo/img/productos/{{$f}}?{{date('Y-m-d H:i:s')}}">
                        </a>
                        @endforeach
                    </div>
                    <h5 class="card-title" style="font-weight: bold">{{$p->nombre}}</h5>
                    @if($p->envasado!="0")
                    <p class="card-text" style="text-align: justify">{!! nl2br($p->envasado) !!}</p> @endif
                    <p class="card-text" style="text-align: justify">@if($p->caracteristicas!='') {!! nl2br($p->caracteristicas) !!} @endif
                    @if(!is_null($p->adj) && ($p->adj!=''))
                        <h5>Documentos adjuntos</h5>
                        @php
                            $adjs=explode(';',$p->adj);
                        @endphp
                        @foreach ($adjs as $ad)
                            @php
                                $tezt=substr($ad,strpos($ad,'_')+1,(strrpos($ad,'.')-strpos($ad,'_')-1));    
                            @endphp
                            <a href="https://reactivaproductiva.feicobol.com/pdf/{{$ad}}" target="_blank"><img src="{{asset('fv/images/adjs.png')}}" style="width: 20%"/>{{$tezt}}</a><br>
                        @endforeach
                    @endif
                    @if(!empty($p->ofert))
                        @foreach($p->ofert as $o)
                            <br><strong style="color:orange">OFERTA: {{$o->nombre_oferta}}</strong><br>{!! nl2br($o->detalle_oferta) !!}
                        @endforeach
                    @endif
                    </p>
                </div>
                @if(($i+1)%4==0)
                    </div>
                @endif
                @endforeach
                @php
                    if(!isset($i))
                        $i=0;    
                @endphp
                @if(($i+1)%4>0)
                    @mobile
                        </div>
                    @elsemobile
                        @php $difer=4-(($i+1)%4) @endphp
                        @if($i>4)
                            @for ( $l=0;$l<$difer;$l++ )
                                <div class="card"></div>
                            @endfor
                        @endif
                        </div>
                    @endmobile
                @endif
            </div>
        </div>
    </div>
</div>
@if(isset($ejecutivos))
<div id="contactos" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Contactos en línea</h4><br>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <span style="font-size: small">Puedes contactar con alguno de nuestros vendedores por este medio!</span>
                <br>
                <div class="row">
                    @foreach($ejecutivos as $ej)
                    <div class="col-md-3">
                        @if(file_exists(public_path().'/img/ejecutivos/'.$ej->id_ejecutivo.".jpg"))
                            <img src="{{asset('/img/ejecutivos/'.$ej->id_ejecutivo.'.jpg')}}" style="width: 100%">
                        @else
                            <img src="{{asset('img/contact.png')}}" style="width: 100%">
                        @endif
                        <h4 style="text-align: center">{{$ej->nombre}}</h4>
                        <span>{!!$ej->cargo!!}</span>
                        <a href="@if($ej->modo_contacto==1) https://wa.me/591{{$ej->link}}?text=Quiero%20mas%20informacion @else https://{{$ej->link}} @endif" target="_blank" class="btn btn-primary">Conversemos!</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</section>
@endsection
@section('head_scripts')
@handheld
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endhandheld

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<style>
    @media(min-width:1023px)
    {
        .iframe-container{
            margin-top:6rem !important;
        }
    }
    .iframe-container{
        margin-top:0rem;
        position: relative;
        width: 100%;
        vertical-align: middle;
        overflow: hidden;
        padding-bottom: 49%;
//        height: 0;
    }
    @if($st->tipo>350)
    .fa{
        margin: 5px 5px;
        padding: 17px;
        font-size: xxx-large;
        text-align: center;
        text-decoration: none;
        border-radius: 10%;
      }
    @else
    .fa{
        margin: 5px 5px;
        padding: 8px;
        font-size: x-large;
        text-align: center;
        text-decoration: none;
        border-radius: 10%;
      }
    @endif
      .fa-facebook {
        background: #3B5998;
        color: white;
      }
      .fa-instagram {
        background: #515BD4;
        color: white;
      }
      .fa-whatsapp {
        background: #25D366;
        color: white;
      }
      .fa-youtube {
        background: red;
        color: white;
      }
      .fa-envelope {
        background: #B23121;
        color: white;
      }
      .fa-phone {
        background: #FF782D;
        color: white;
      }
    .chat:hover{
        opacity: 0.8;
    }      
    @media(max-width:1023px)
    {
        .chat{
            width:40% !important;
        }
    }
    @media(max-width:320px)
    {
        .chat{
            width:50% !important;
            bottom:40% !important;
            right: 0px !important;
        }
    }
</style>
@endsection
@section('scripts')
@handheld
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/jquery.ui.touch-punch.min.js')}}"></script>
@endhandheld
<script>
var modals=0;
var moda=true;
    @desktop
    function mostrarfono(){
        $('#fono_show').toggle();
    }
    @enddesktop
    var tilelay=L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://cloudmade.com">CloudMade</a>',
        maxZoom: 18
        });
    var sucursalesmap = L.map('sucursales-map',    {
        zoomControl: true,
        layers:tilelay,
        maxZoom: 18,
        minZoom: 6
      }).setView([parseFloat({{$st->lat}}),parseFloat({{$st->lon}})], 13);
      @if(!isset($stands))
      var mark = L.marker([{{$st->lat}},{{$st->lon}}]).addTo(sucursalesmap);
      @endif
      @foreach($sucs as $s)
        var mark = L.marker([{{$s->lat}},{{$s->lon}}]).addTo(sucursalesmap);
      @endforeach
function ver(lat,lon){
    sucursalesmap.setView([lat,lon],15);
    setTimeout(function () { sucursalesmap.invalidateSize();}, 500);
}
@if($st->video!='')
function popovers(){
    if(moda){
    $('#pop4').popover('hide');   
    $('#pop1').popover('show');   
    setTimeout(    
        function(){
            if(moda){
            $('#pop1').popover('hide');
            $('#pop2').popover('show');
            setTimeout(    
                function(){
                    if(moda){
                    $('#pop2').popover('hide');
                    $('#pop3').popover('show');
                    setTimeout(    
                        function(){
                            if(moda){
                            $('#pop3').popover('hide');
                            $('#pop4').popover('show');
                            setTimeout(
                                function(){
                                    if(moda){
                                    $('#pop4').popover('hide');
                                    }
                                },2000);        
                            }
                        },2000);
                    }
                },2000);
            }
        },2000);
    }
}
function hide_popovers(){
    $('#pop1').popover('hide');   
    $('#pop2').popover('hide');   
    $('#pop3').popover('hide');   
    $('#pop4').popover('hide');   
}
@else
function popovers(){
    if(moda){
    $('#pop3').popover('hide');   
    $('#pop1').popover('show');   
    setTimeout(    
        function(){
            if(moda){
            $('#pop1').popover('hide');
            $('#pop2').popover('show');
            setTimeout(    
                function(){
                    if(moda){
                    $('#pop2').popover('hide');
                    $('#pop3').popover('show');
                    setTimeout(
                        function(){
                            if(moda){
                            $('#pop3').popover('hide');
                            }
                        },2000);        
                    }
                },2000);
            }
        },2000);
    }
}
function hide_popovers(){
    $('#pop1').popover('hide');   
    $('#pop2').popover('hide');   
    $('#pop3').popover('hide');   
}
@endif
@mobile
var maxMenuWidth=3000;
var w1=$('#drag').outerWidth();
var w2=$('#dra_g').outerWidth();
@endmobile
$(document).ready( function () {
    @mobile
//    dra_g---;width:1240px;transform:translateX(-440px)
    $("#dra_g").css('width',1600-$( window ).width());
    $("#dra_g").css('transform','translateX(-'+(800-$( window ).width())+'px)');
    $(".modal").css('width',$( window ).width()+'px');
    console.log(w1);
    console.log(w2);
    maxMenuWidth=w2;
    $( "#drag" ).draggable({ axis: 'x' ,cursor: 'move', containment:'parent'
});
    @endmobile
    @if($st->video!='')
        popovers();
//        var myVar=setInterval(popovers, 8000);
    @else
        popovers();
//        var myVar=setInterval(popovers, 6000);
    @endif
    $('#contactos').on('shown.bs.modal',function(){
        modals++;
        moda=false;
//        clearInterval(myVar);
        hide_popovers();
    });
    $('#contactos').on('hidden.bs.modal',function(){
        modals--;
        moda=true;
        @if($st->video!='')
            popovers();
//            var myVar=setInterval(popovers, 8000);
        @else
            popovers();
//            var myVar=setInterval(popovers, 6000);
        @endif
    });
    $('#productos').on('shown.bs.modal',function(){
        modals++;
        moda=false;
//        clearInterval(myVar);
        hide_popovers();
    });
    $('#productos').on('hidden.bs.modal',function(){
        modals--;
        moda=true;
        @if($st->video!='')
            popovers();
//            var myVar=setInterval(popovers, 8000);
        @else
            popovers();
//            var myVar=setInterval(popovers, 6000);
        @endif
    });
    $('#nosotros').on('shown.bs.modal',function(){
        modals++;
        moda=false;
//        clearInterval(myVar);
        hide_popovers();
        setTimeout(function () { sucursalesmap.invalidateSize();}, 500);
    });
    $('#nosotros').on('hidden.bs.modal',function(){
        modals--;
        moda=true;
        @if($st->video!='')
            popovers();
//            var myVar=setInterval(popovers, 8000);
        @else
            popovers();
//            var myVar=setInterval(popovers, 6000);
        @endif
    });
    @if($st->video!='')
        $('#video').on('shown.bs.modal',function(){
            modals++;
            moda=false;
//            clearInterval(myVar);
            hide_popovers();
        });
        $('#video').on('hidden.bs.modal',function(){
            modals--;
            moda=true;
            popovers();
//            var myVar=setInterval(popovers, 8000);
        });
    @endif
    $('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

});
</script>
@endsection
