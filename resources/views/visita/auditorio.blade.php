@extends('layouts.appVisita',['mapa'=>true,'title'=>'Bienvenido al Auditorio','height_desk'=>800,'height'=>170])
@section('modal_confirm')
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Eventos Anteriores</h2>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(!empty($eventos))
                    @foreach($eventos as $ev)
                    <div class="col-md-3">
                        <a href="{{route('teatro',['id'=>$ev->link])}}" style="position: relative">
                            <img src="{{asset('fv/images/video_'.$ev->link.'.jpg')}}" style="width: 100%" />
                            <span class="playBtn" style="  position: absolute; z-index: 2;
                            width: 50px; height: 50px;
                            left: 0; right: 0; top: 0; bottom: 0; margin: auto; /* center */
                          ">
                                <img src="https://wptf.com/wp-content/uploads/2014/05/play-button.png" width="50" height="50" alt=""></span>
                            <h4>{{$ev->nombre}}</h4>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="iframe-container">
    <svg style="	display: inline-block;
    position: absolute;
    top: 0; left: 0;" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 1942 1016" preserveAspectRatio="xMinYMin meet" >
    <image width="1942" height="1016" xlink:href="{{asset('fv/images/teatro3_1.jpg')}}"></image>
    <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
        <rect x="1150" y="880" width="530" height="110" points="1340,1090,1570,1225" fill="#fff" opacity="0" />
    </a>
    <a xlink:href="#" data-toggle="modal" data-target="#myModal">
        <rect x="210" y="880" width="440" height="110" points="1340,1090,1570,1225" fill="#fff" opacity="0" />
    </a>
    @if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))

        @if(isset($vant->link))
            <a xlink:href="https://www.youtube.com/watch?v={{$vant->link}}" target="_blank">
                <image xlink:href="{{asset('fv/images/video_'.$vant->link.'.jpg')}}" x="580" y="250" width="830" height="402" />
                <image xlink:href="https://wptf.com/wp-content/uploads/2014/05/play-button.png" x="580" y="250" width="830" height="402"  />
        @else
            <a xlink:href="https://www.youtube.com/watch?v=XTS1KcqHgyE" target="_blank">
                <image xlink:href="{{asset('fv/images/video_XTS1KcqHgyE.jpg')}}" x="580" y="250" width="830" height="402" />
                <image xlink:href="https://wptf.com/wp-content/uploads/2014/05/play-button.png" x="580" y="250" width="830" height="402"  />
            @endif
            <rect x="0" y="0" width="1942" height="900" fill="#fff" opacity="0" />
        </a>
    @else
    <foreignObject x="580" y="250" width="830px" height="402px" style="position:relative">
        @if(isset($vant->link))
            <iframe xmlns="http://www.w3.org/1999/xhtml" id="player" width="100%" height="100%" type="text/html" style="position: fixed" src="https://www.youtube-nocookie.com/embed/{{$vant->link}}?enablejsapi=1&origin=https://{{$_SERVER['SERVER_NAME']}}&autoplay=0" data-title="YouTube video player" frameborder="0" allow="accelerometer;encrypted-media;gyroscope;picture-in-picture" allowfullscreen="1"></iframe>
        @else
            <iframe xmlns="http://www.w3.org/1999/xhtml" id="player" width="100%" height="100%" type="text/html" style="position: fixed"  src="https://www.youtube-nocookie.com/embed/XTS1KcqHgyE?enablejsapi=1&origin=https://{{$_SERVER['SERVER_NAME']}}&autoplay=0" data-title="YouTube video player" frameborder="0" allow="accelerometer;encrypted-media;gyroscope;picture-in-picture" allowfullscreen="1"></iframe>
        @endif
    </foreignObject>
    @endif
    <a href="{{route('visita_stand',['stand'=>524])}}">
        <image x="590" y="651" height="61" width="782" xlink:href="{{asset('img/auspicio_bfie.jpg')}}" id="pop4" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver a nuestro auspiciador"></image>
        <image x="655" y="890" height="101" width="266" xlink:href="{{asset('img/auspicio_bfie.jpg')}}" id="pop4" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver a nuestro auspiciador"></image>
    </a>

</svg>    
</div>

@endsection
@section('scripts')

@endsection
@section('head_scripts')
@if(!isset($no_actualizar))
    @if(!isset($vant->link))
        <meta http-equiv="refresh" content="75">
    @elseif(isset($videos->fecha_inicio))        
        @php
            $segundos=strtotime($videos->fecha_inicio)-strtotime(date('Y-m-d H:i:s'));
        @endphp
        <meta http-equiv="refresh" content="{{$segundos}}">
    @endif
@endif
<style>
    .iframe-container{
        margin-top:6rem;
        position: relative;
        width: 100%;
        vertical-align: middle;
        overflow: hidden;
        padding-bottom: 56%;
        height: 0;
    }
</style>
@endsection 