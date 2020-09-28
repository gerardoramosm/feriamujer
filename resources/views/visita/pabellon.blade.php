@extends('layouts.appVisita',['mapa'=>true,'title'=>'Bienvenido al Pabellón '.$p->nombre,'height_desk'=>1040,'height'=>450,'nohero'=>true])
@section('modal_confirm')
@if($vivo)
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="{{route('auditorio')}}">
                <img src="{{asset('fv/images/vivo.jpg')}}" style="width: 100%">
                <button type="button" href="#" class="btn btn-info">Llévame al Auditorio</button></a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
        @section('body')
        @php $pad=array("74","74","74","74","74","74","74","74","74"); $poly_area="1719,663,1421,303,509,295,194,663"; @endphp
            <section class="ftco-section ftco-no-pt ftco-no-pb">
                <figure id="burj" style="position: relative;
                width: 100%;
                @desktop
                    top:85px;
                @enddesktop
                padding-bottom: {{$pad[$p->id_rubro-64]}}%;
                vertical-align: middle;
                margin: 0;
                overflow: hidden;">
                @if($p->id_rubro==66)
                <svg style="	display: inline-block;
                position: absolute;
                top: 0; left: 0;" version="2" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 1103 677" preserveAspectRatio="xMinYMin meet" >
                    <image width="1103" height="677" xlink:href="{{asset('img/pabellon_'.$p->id_rubro.'_abajo.jpg?1')}}">
                        </image>
                        <rect x="839" y="536" height="142" width="264" onclick="sube()" fill="transparent"></rect>
                    @else
                    <svg style="	display: inline-block;
                    position: absolute;
                    top: 0; left: 0;" version="2" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 2396 1784" preserveAspectRatio="xMinYMin meet" >
                            <image width="2396" height="1784" xlink:href="{{asset('img/pabellon_'.$p->id_rubro.'.jpg?1')}}">
                        </image>
                        <polygon points="{{$poly_area}}" fill="#fff" opacity="0" id="pop1" data-container="body" data-toggle="popover" data-placement="bottom" title="Puedes hacer clic en el stand que quieras visitar!" />
                        @endif
                    @php $i=0; @endphp
                    @foreach($stands as $s)
                    @if(($i<13 && $p->id_rubro==66) || $p->id_rubro<66)
                        @if($s->stands==1)
                            @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa.'.jpg'))
                                <foreignObject x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}px" height="{{$he[$i]}}px" transform="skewX({{$giro[$i]}})" >
                                    <p style="text-align: center;font-size:x-small;font-weight:bolder;background-color:white;opacity:0.8">{{$s->nombre_empresa}}</p>
                                </foreignObject>
                            @else
                                <image x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}" height="{{$he[$i]}}" transform="skewX({{$giro[$i]}})" xlink:href="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa}}.jpg?{{date('Y-m-d H:i')}}"></image>
                            @endif
                            <a xlink:href="{{route('visita_stand',['stand'=>$s->id_empresa])}}">
                                <polygon points="{{$poly[$i]}}" fill="#fff" opacity="0" >
                            </a>
                            @php $i++; @endphp
                        @else
                            @foreach ($s->detalle_stands as $sts)
                                @if(($i<13 && $p->id_rubro==66) || $p->id_rubro<66)
                                @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa."_".$sts->id_stand.'.jpg'))
                                    <foreignObject x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}px" height="{{$he[$i]}}px" transform="skewX({{$giro[$i]}})" >
                                        <p style="text-align: center;font-size:x-small;font-weight:bolder;background-color:white;opacity:0.8">{{$sts->nombre}}</p>
                                    </foreignObject>
                                @else
                                    <image x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}" height="{{$he[$i]}}"  xlink:href="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa."_".$sts->id_stand}}.jpg?{{date('Y-m-d H:i')}}"></image>
                                @endif
                                <a xlink:href="{{route('visita_stand',['stand'=>$s->id_empresa."_".$sts->id_stand])}}"> 
                                    <polygon points="{{$poly[$i]}}" fill="#fff" opacity="0" >
                                </a>
                                @endif
                                @php $i++; @endphp
                            @endforeach
                        @endif
                    @endif
                    @endforeach
                    @if($p->id_rubro==64)
                    <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                        <image x="77" y="345" height="365" width="390" transform="skewY(-20)" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        <image x="1165" y="179" height="157" width="209" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                    </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="956" y="179" height="157" width="209" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                            <image x="1824" y="-260" height="220" width="349" transform="skewY(15)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="956" y="179" height="157" width="209" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                            <image x="1824" y="-260" height="220" width="349" transform="skewY(15)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a xlink:href="https://www.boa.bo" target="_blank">
                            <image x="720" y="180" height="156" width="200" xlink:href="{{asset('img/boa_pabellones.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                            <image x="1414" y="180" height="156" width="200" xlink:href="{{asset('img/boa_pabellones.jpg')}}"></image>
                        </a>
                        <a href="{{route('pabellon',['id'=>53])}}">
                            <rect x="389" y="542" height="135" width="217" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="1735" y="542" height="135" width="217" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==61)
                    <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                        <image x="121" y="103" height="459" width="327" transform="skewY(-17)" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        <image x="1220" y="71" height="271" width="295" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                    </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="925" y="71" height="271" width="295" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                            <image x="2013" y="-350" height="333" width="322" transform="skewY(12)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="924" y="319" height="234" width="294" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                            <image x="2013" y="-350" height="333" width="322" transform="skewY(12)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a xlink:href="https://www.boa.bo" target="_blank">
                            <image x="595" y="73" height="269" width="279" xlink:href="{{asset('img/boa_pabellones.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                            <image x="1575" y="73" height="269" width="279" xlink:href="{{asset('img/boa_pabellones.jpg')}}"></image>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="127" y="617" height="231" width="303" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="2031" y="617" height="231" width="303" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==65)
                    <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                        <image x="170" y="320" height="339" width="220" transform="skewY(-22)" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        <image x="902" y="98" height="207" width="234" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                    </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="1136" y="98" height="207" width="235" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                            <image x="2000" y="-750" height="300" width="230" transform="skewY(25)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="1136" y="98" height="207" width="235" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                            <image x="2000" y="-750" height="300" width="230" transform="skewY(25)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a xlink:href="https://www.boa.bo" target="_blank">
                            <image x="450" y="350" height="280" width="125" transform="skewY(-22)" xlink:href="{{asset('img/boa_pabellones.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                            <image x="1820" y="-730" height="242" width="130" transform="skewY(25)" xlink:href="{{asset('img/boa_pabellones.jpg')}}"></image>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="166" y="698" height="208" width="283" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="1952" y="698" height="208" width="283" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==62)
                    <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                        <image x="19" y="344" height="431" width="301" transform="skewY(-20)" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        <image x="1203" y="239" height="293" width="260" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                    </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="943" y="239" height="293" width="260" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                            <image x="2073" y="-661" height="325" width="291" transform="skewY(24)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="943" y="239" height="293" width="260" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                            <image x="2073" y="-661" height="325" width="291" transform="skewY(24)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a xlink:href="https://www.boa.bo" target="_blank">
                            <image x="1537" y="239" height="291" width="365" xlink:href="{{asset('img/boa_pabellones.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                            <image x="505" y="239" height="293" width="371" xlink:href="{{asset('img/boa_pabellones.jpg')}}"></image>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="17" y="835" height="223" width="307" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="2053" y="819" height="221" width="327" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==63)
                    <a href="{{asset('img/modif_stands/vmpe.jpg')}}" class="gallery image-popup img d-flex align-items-center">
                        <image x="567" y="299" height="221" width="335" xlink:href="{{asset('img/modif_stands/vmpe.jpg')}}" ></image>
                    </a>
                    <a href="{{asset('img/modif_stands/vmt.jpg')}}" class="gallery image-popup img d-flex align-items-center">
                        <image x="963" y="299" height="221" width="235" xlink:href="{{asset('img/modif_stands/vmt.jpg')}}" ></image>
                    </a>
                    <a href="{{asset('img/modif_stands/vpimge.jpg')}}" class="gallery image-popup img d-flex align-items-center">
                        <image x="1198" y="299" height="221" width="235" xlink:href="{{asset('img/modif_stands/vpimge.jpg')}}" ></image>
                    </a>
                    <a href="{{asset('img/modif_stands/vci.jpg')}}" class="gallery image-popup img d-flex align-items-center">
                        <image x="1495" y="299" height="221" width="333" xlink:href="{{asset('img/modif_stands/vci.jpg')}}" ></image>
                    </a>
                    @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="209" y="439" height="300" width="241" transform="skewY(-20)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                            <image x="1943" y="-285" height="231" width="239" transform="skewY(17)" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="209" y="439" height="300" width="241" transform="skewY(-20)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                            <image x="1943" y="-285" height="231" width="239" transform="skewY(17)" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="123" y="749" height="167" width="217" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="2059" y="749" height="167" width="217" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==60)
                        <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                            <image x="846" y="193" height="101" width="175" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="1330" y="193" height="101" width="175" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="1330" y="193" height="101" width="175" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="423" y="493" height="104" width="152" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>$p->id_rubro+1])}}">
                            <rect x="1779" y="493" height="104" width="152" fill="transparent"></rect>
                        </a>
                    @endif
                    @if($p->id_rubro==66)
                        <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                            <image x="356" y="73" height="46" width="96" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="657" y="73" height="46" width="96" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="657" y="73" height="46" width="96" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="22" y="261" height="65" width="107" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>47])}}">
                            <rect x="978" y="262" height="64" width="111" fill="transparent"></rect>
                        </a>
                    @endif
                    </svg>
                </figure>
                @if($p->id_rubro==66)
                <figure id="burj_1" style="display:none;position: relative;
                width: 100%;
                @desktop
                    top:85px;
                @enddesktop
                padding-bottom: {{$pad[$p->id_rubro-64]}}%;
                vertical-align: middle;
                margin: 0;
                overflow: hidden;">

                <svg style="	display: inline-block;
                position: absolute;
                top: 0; left: 0;" version="2" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 1103 677" preserveAspectRatio="xMinYMin meet" >
                    <image width="1103" height="677" xlink:href="{{asset('img/pabellon_'.$p->id_rubro.'_arriba.jpg?1')}}">
                    </image>
                    <rect x="839" y="536" height="142" width="264" onclick="baja()" fill="transparent"></rect>
                    @php $i=0;  @endphp
                    @foreach($stands as $s)
                        @if($s->stands==1)
                            @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa.'.jpg'))
                                <foreignObject x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}px" height="{{$he[$i]}}px" transform="skewX({{$giro[$i]}})" >
                                    <p style="text-align: center;font-size:x-small;font-weight:bolder;background-color:white;opacity:0.8">{{$s->nombre_empresa}}</p>
                                </foreignObject>
                            @else
                                <image x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}" height="{{$he[$i]}}" transform="skewX({{$giro[$i]}})" xlink:href="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa}}.jpg?1"></image>
                            @endif
                            <a xlink:href="{{route('visita_stand',['stand'=>$s->id_empresa])}}">
                                <polygon points="{{$poly[$i]}}" fill="#fff" opacity="0" >
                            </a>
                            @php $i++; @endphp
                        @else
                            @foreach ($s->detalle_stands as $sts)
                            @if($i>=13)
                                @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa."_".$sts->id_stand.'.jpg'))
                                    <foreignObject x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}px" height="{{$he[$i]}}px" transform="skewX({{$giro[$i]}})" >
                                        <p style="text-align: center;font-size:x-small;font-weight:bolder;background-color:white;opacity:0.8">{{$sts->nombre}}</p>
                                    </foreignObject>
                                @else
                                    <image x="{{$x[$i]}}" y="{{$y[$i]}}" width="{{$wi[$i]}}" height="{{$he[$i]}}"  xlink:href="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa."_".$sts->id_stand}}.jpg"></image>
                                @endif
                                <a xlink:href="{{route('visita_stand',['stand'=>$s->id_empresa."_".$sts->id_stand])}}"> 
                                    <polygon points="{{$poly[$i]}}" fill="#fff" opacity="0" >
                                </a>
                            @endif
                                @php $i++; @endphp
                            @endforeach
                        @endif
                    @endforeach
                    @if($p->id_rubro==66)
                        <a xlink:href="#" data-toggle="modal" data-target="#ofertasModal">
                            <image x="356" y="73" height="46" width="96" xlink:href="{{asset('fv/images/ofertas.jpg')}}" id="pop3_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver las Ofertas!"></image>
                        </a>
                        @if(file_exists(dirname(base_path()).'/reactiva/public/fv/images/programa-'.date('Y-m-d').'.jpg'))
                        <a href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}"  class="gallery image-popup img d-flex align-items-center">
                            <image x="657" y="73" height="46" width="96" xlink:href="{{asset('fv/images/programa-'.date('Y-m-d').'.jpg')}}" id="pop2_1" data-container="body" data-toggle="popover" data-placement="bottom" title="Clic aquí para ver el programa de actividades"></image>
                        </a>
                        @else
                            <image x="657" y="73" height="46" width="96" xlink:href="{{asset('img/logo-colores.png')}}"></image>
                        @endif
                        <a href="{{route('pabellon',['id'=>$p->id_rubro-1])}}">
                            <rect x="22" y="261" height="65" width="107" fill="transparent"></rect>
                        </a>
                        <a href="{{route('pabellon',['id'=>47])}}">
                            <rect x="978" y="262" height="64" width="111" fill="transparent"></rect>
                        </a>
                    @endif
                    </svg>
                </figure>
                @endif
                <div class="container">
                    @if($p->id_rubro==63)
                        <h1 style="text-align: center;">INSTITUCIONES PARTICIPANTES</h1>
                    @else
                        <h1 style="text-align: center;">EMPRESAS PARTICIPANTES</h1>
                    @endif
                    <div class="row d-flex">
              <div class="form-group row">
            @foreach($stands as $s)
                @if($s->stands==1)
                <div class="col-md-6">
                    <div class="row request-form">
                            <div class="col col-md-4 form-group">
                                @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa.'.jpg'))
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa])}}" class="btn btn-primary py-3 px-4"> 
                                    {{$s->nombre_empresa}}
                                @else
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa])}}" class="btn btn-outline-primary"> 
                                    <img width="100%" src="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa}}.jpg?{{date('Y-m-d H:i')}}" />
                                @endif                                                            
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa])}}">
                                <h4>{{$s->nombre_empresa}}</h4>
                                <div class="text">
                                    <p>{{$s->descripcion}}</p>
                                </div>
                                </a>
                            </div>
                    </div>
                </div>
                @else
                    @foreach ($s->detalle_stands as $sts)
                    <div class="col-6">
                        <div class="row request-form">
                                <div class="col col-md-4 form-group">
                                @if(!file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$s->id_empresa."_".$sts->id_stand.'.jpg'))
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa."_".$sts->id_stand])}}" class="btn btn-primary py-3 px-4">
                                    {{$sts->nombre}}
                                @else
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa."_".$sts->id_stand])}}" class="btn btn-outline-primary">
                                    <img width="100%" src="https://expositores.feicobol.com.bo/images/logos/{{$s->id_empresa."_".$sts->id_stand}}.jpg?{{date('Y-m-d H:i')}}" />
                                @endif
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{route('visita_stand',['stand'=>$s->id_empresa."_".$sts->id_stand])}}">
                                <h4>{{$sts->nombre}}</h4>
                                <div class="text">
                                    <p>{{$sts->descripcion}}</p>
                                </div></a>
                            </div>
                    </div>
                </div>
                @endforeach
                @endif
            @endforeach
                </div>
            </div>
        </div>
            </section>
            @if(isset($ofertas))
            <div id="ofertasModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="text-align: center">Pizarra de Ofertas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="font-size: small">
                                @foreach($ofertas as $o)
                                <div class="col-md-4" style="text-align: justify;border:dashed">
                                    <h4 style="font-size: medium;text-align:center; font-weight:bolder;color:orange;text-transform:uppercase">{{$o->nombre}}</h4>
                                    {!!$o->detalle!!}<br><strong>Producto(s) en oferta: </strong>{{$o->producto}}<br>
                                    <a href="{{route('visita_stand',['stand'=>$o->id_stand])}}" style="display: grid" class="btn btn-danger">Ir al stand</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    @endsection
@section('head_scripts')
@handheld
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@mobile
<style>
    .mfp-wrap {
        width: 100vw;
        height: 100vh}      
</style>
@endmobile
@endhandheld
        
@endsection
@section('scripts')
@handheld
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('js/jquery.ui.touch-punch.min.js')}}"></script>
@endhandheld
<script>
    function popovers(){
        $('#pop3_1').popover('hide');
        $('#pop3_2').popover('hide');
        $('#pop1').popover('show');   
        setTimeout(    
            function(){
                $('#pop1').popover('hide');
                $('#pop2_1').popover('show');
                $('#pop2_2').popover('show');
                setTimeout(    
                    function(){
                        $('#pop2_1').popover('hide');
                        $('#pop2_2').popover('hide');
                        $('#pop3_1').popover('show');
                        $('#pop3_2').popover('show');
                        setTimeout(
                            function(){
                                hidepopovers();
                            },2000);
                    },2000);
            },2000);
    }
function hidepopovers(){
    $('#pop1').popover('hide');
    $('#pop2_1').popover('hide');
    $('#pop2_2').popover('hide');
    $('#pop3_1').popover('hide');
    $('#pop3_2').popover('hide');
}
function sube(){
    $('#burj').css('display','none');
    $('#burj_1').css('display','block');
}
function baja(){
    $('#burj_1').css('display','none');
    $('#burj').css('display','block');
}
</script>
@if($vivo)
<script>
    @mobile
    var maxMenuWidth=1230;
    var w1=$('#drag').outerWidth();
    var w2=$('#dra_g').outerWidth();
    @endmobile
        $(document).ready( function () {
    @mobile
//    dra_g---;width:1240px;transform:translateX(-440px)
    if($( window ).width()<768)
    $("#dra_g").css('width',1200-$( window ).width());
    $("#dra_g").css('transform','translateX(-'+(400-$( window ).width())+'px)');
    $(".modal").css('width',$( window ).width()+'px');
    console.log(w1);
    console.log(w2);
    maxMenuWidth=w2;
    $( "#drag" ).draggable({ axis: 'x' ,cursor: 'move', containment:'parent'});
    @endmobile
        $("#myModal").modal('show');
        popovers();
//        setInterval(popovers, 10000);
        setTimeout(function () {
            $("#myModal").modal('hide');
        }, 5000);
    });
    $(document).on('click', function(e) {
        hidepopovers();
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
        $('#dra_g').css('height',((parseInt($( window ).height())*0.6)-parseInt($('.navbar').css('height'))));
        console.log('hola'+$( window ).height()+';'+$('.navbar').css('height')+"---");
    @mobile
//    dra_g---;width:1240px;transform:translateX(-440px)
    if($( window ).width()<768)
    $("#dra_g").css('width',1250-$( window ).width());
    $("#dra_g").css('transform','translateX(-'+(700-$( window ).width())+'px)');
    $(".modal").css('width',$( window ).width()+'px');
    console.log(w1);
    console.log(w2);
    maxMenuWidth=w2;
    $( "#drag" ).draggable({ axis: 'x' ,cursor: 'move', containment:'parent'
});
    @endmobile
        popovers();
//        setInterval(popovers, 10000);
    });
    $(document).on('click', function(e) {
        hidepopovers();
    });
</script>
@endif
@endsection
