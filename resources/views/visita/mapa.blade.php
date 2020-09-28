@extends('layouts.appVisita',['mapa'=>false,'title'=>'Navega por el mapa e ingresa al pabellón que desees visitar','height_desk'=>940,'height'=>200])
@section('modal_confirm')
@if($vivo)
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cerrar &times;</button>
                <a href="{{route('auditorio')}}">
                <img src="{{asset('fv/images/vivo.jpg')}}" style="width: 100%">
                <button type="button" href="#" class="btn btn-info">Llévame al Teatro</button></a>
            </div>
        </div>
    </div>
</div>
@else
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cerrar &times;</button>
                <img src="{{asset('fv/images/programa_'.date('Y-m-d').'.jpg')}}" style="width: 100%">
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('content')
<!--<div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">-->
            <section class="ftco-section ftco-no-pt ftco-no-pb">
                <figure id="burj" style="position: relative;
                width: 100%;
                @desktop
                    top:85px;
                @enddesktop
                padding-bottom: 57%;
                vertical-align: middle;
                margin: 0;
                overflow: hidden;">

                <svg style="	display: inline-block;
                position: absolute;
                top: 0; left: 0;" version="2" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 1280 720" preserveAspectRatio="xMinYMin meet" >

<!--        <figure id="burj" style="position: relative;
        width: 100%;
        @desktop
            top:85px;
        @enddesktop
        padding-bottom: 57%;
        vertical-align: middle;
        margin: 0;
        overflow: hidden;">
            <svg style="	display: inline-block;
            position: absolute;
            top: 0; left: 0;" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 1280 720" preserveAspectRatio="xMinYMin meet" >-->
            <image width="1280" height="720" xlink:href="{{asset('fv/images/mapa6.jpg')}}">
            </image>
            <a xlink:href="{{route('auditorio')}}">
                <polygon points="399,554,394,483,431,292,842,296,883,488,876,548" fill="#fff" opacity="0"  id="pop4" data-container="body" data-toggle="popover" data-placement="bottom" title="Mira las conferencias profesionales que tenemos!">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>60])}}">
                <polygon points="167,545,158,495,223,330,367,330,372,386,332,551" fill="#fff" opacity="0" id="pop1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Recinto Penitenciario El Abra">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>66])}}">
                <polygon points="947,564,904,394,911,341,1134,343,1213,511,1199,566" fill="#fff" opacity="0"  id="pop3" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Carceleta Aráni">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>65])}}">
                <polygon points="880,292,856,187,858,144,1036,145,1092,260,1064,317" fill="#fff" opacity="0"  id="pop3" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Centro Penitenciario San Sebastián Varones">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>63])}}">
                <polygon points="469,152,478,59,790,60,801,152" fill="#fff" opacity="0"  id="pop3" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Centro Penitenciario San Pablo de Quillacollo">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>62])}}">
                <polygon points="123,0,380,0,428,66,414,116,103,113,133,64" fill="#fff" opacity="0"  id="pop3" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Centro de Rehabilitación San Antonio">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>61])}}">
                <polygon points="261,286,250,247,250,162,296,139,414,141,387,290" fill="#fff" opacity="0"  id="pop2" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Centro Penitenciario San Pedro de Sacaba">
                </a>
            <a xlink:href="{{route('pabellon',['pabellon'=>64])}}">
                <polygon points="891,140,870,113,876,61,977,38,1118,38,1187,63,1229,119,1222,146" fill="#fff" opacity="0"  id="pop3" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí si quieres visitar el Pabellón Centro Penitenciario San Sebastián Mujeres">
                </a>
            </svg>
        </figure>
    @handheld
    @section('body')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="form-group row">
                    <div class="col-6 form-group">
                        <a href="{{route('auditorio')}}" class="btn btn-primary py-3 px-4"> Auditorio</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>66])}}" class="btn btn-primary py-3 px-4"> Pabellón Carceleta Aráni</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>60])}}" class="btn btn-primary py-3 px-4"> Pabellón Recinto Penitenciario El Abra</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>63])}}" class="btn btn-primary py-3 px-4"> Pabellón Centro Penitenciario San Pablo de Quillacollo</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>64])}}" class="btn btn-primary py-3 px-4"> Pabellón Centro Penitenciario San Sebastián Mujeres</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>61])}}" class="btn btn-primary py-3 px-4"> Pabellón Centro Penitenciario San Pedro de Sacaba</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>65])}}" class="btn btn-primary py-3 px-4"> Pabellón Centro Penitenciario San Sebastián Varones</a>
                    </div>
                    <div class="col-6 form-group">
                        <a href="{{route('pabellon',['pabellon'=>62])}}" class="btn btn-primary py-3 px-4"> Pabellón Centro de Rehabilitación San Antonio</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @endhandheld
@endsection
@section('head_scripts')
@handheld
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endhandheld
        
@endsection

@section('scripts')
@handheld
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/jquery.ui.touch-punch.min.js')}}"></script>
@endhandheld
<script>
    function popovers(){
        $('#pop4').popover('hide');   
        $('#pop1').popover('show');   
        setTimeout(    
            function(){
                $('#pop1').popover('hide');
                $('#pop2').popover('show');
                setTimeout(    
                    function(){
                        $('#pop2').popover('hide');
                        $('#pop3').popover('show');
                        setTimeout(    
                            function(){
                                $('#pop3').popover('hide');
                                $('#pop4').popover('show');        
                            },2000);
                    },2000);                    
            },2000);
    }
</script>
@if($vivo)
<script>
    @mobile
    var maxMenuWidth=3000;
    var w1=$('#drag').outerWidth();
    var w2=$('#dra_g').outerWidth();
    @endmobile
    $(document).ready( function () {
        @mobile
            $(".hero-wrap").css('height','450px !important');
            $('#dra_g').css('height',((parseInt($( window ).height())*0.6)-parseInt($('.navbar').css('height'))));
            $('#drag').css('height',((parseInt($( window ).height())*0.6)-parseInt($('.navbar').css('height'))));
            $(".hero-wrap").css('height',$('#dra_g').css('height'));
            console.log("aaa"+$('#dra_g').css('height'));
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
                $("#myModal").modal('show');
        //popovers();
        //setInterval(popovers, 10000);
        setTimeout(function () {
            $("#myModal").modal('hide');
        }, 5000);
    });
</script>    
@else
<script>
    @mobile
    var maxMenuWidth=3000;
    var w1=$('#drag').outerWidth();
    var w2=$('#dra_g').outerWidth();
    @endmobile
    $(document).ready( function () {
        @mobile
        //    dra_g---;width:1240px;transform:translateX(-440px)
            $(".hero-wrap").css('height','450px');
            $('#dra_g').css('height',((parseInt($( window ).height())*0.6)-parseInt($('.navbar').css('height'))));
            $('#drag').css('height',((parseInt($( window ).height())*0.6)-parseInt($('.navbar').css('height'))));
            $(".hero-wrap").attr('style','height:'+$('#dra_g').css('height')+" !important");
            console.log("baa"+$('#dra_g').css('height')+" !important");
            $("#dra_g").css('width',1600-$( window ).width());
            $("#dra_g").css('transform','translateX(-'+(600-$( window ).width())+'px)');
            $(".modal").css('width',$( window ).width()+'px');
            console.log(w1);
            console.log(w2);
            maxMenuWidth=w2;
            $( "#drag" ).draggable({ axis: 'x' ,cursor: 'move', containment:'parent'
        });
            @endmobile
//                $("#myModal").modal('show');
        //popovers();
        //setInterval(popovers, 10000);
    });
</script>    
@endif
@endsection
