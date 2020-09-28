@extends('layouts.appFV',['menu'=>$menu,'link'=>$link])
@section('modal_confirm')
@if(session('status'))
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <img src="{{asset('img/checkmark.gif')}}" style="width: 100%">
                <h3 style="text-align: center">{{session('status')}}</h3>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="{{isset($pago) ? 'col-md-8' : 'col-md-12'}}">
                <div class="panel panel-default ">
                    <div class="panel-body bg-light p-3 ">
                        <h2 style="text-align: center">
                            <img src="{{file_exists(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa.'.jpg') ? url('https://expositores.feicobol.com.bo/images/logos/'.Auth::user()->id_empresa.'.jpg') : url('https://expositores.feicobol.com.bo/images/logos/suba_su_logo.png')}}" style="width: 30%">
                            {{Auth::user()->nombre_empresa}}</h2>
                        <div class="row">
                        <div class="col-md-7">
                            <div class="speaker ftco-animate speaker-1 d-flex align-items-center">
                                <!-- Logo de la empresa -->
                                <div class="text pl-4" style="text-align: center">
                                    <h4 style="text-align: center">Datos de la empresa</h2>
                                    <p style="text-align: justify">
                                        <label><span class="icon-file" style="font-weight: bold">NIT</span></label> {{Auth::user()->nit}}<br>
                                        <label><span class="icon-phone" style="font-weight: bold">Teléfono de contacto </span></label> {{Auth::user()->telefono}}<br>
                                        <label><span class="icon-map" style="font-weight: bold">Ciudad</span></label> {{$ciud}} - {{$pais}}<br>
                                        <label><span class="icon-at" style="font-weight: bold">Correo Electrónico</span></label> {{Auth::user()->email}}<br>
                                        <label><span class="icon-globe" style="font-weight: bold">Página Web</span></label> {{Auth::user()->web}}<br>
                                        <label><span class="icon-whatsapp" style="font-weight: bold">Número de Whatsapp</span></label> {{$d->wpp}}<br>
                                        <label><span class="icon-instagram" style="font-weight: bold">Página de Instagram</span></label> {{$d->ig}}<br>
                                        <label><span class="icon-facebook" style="font-weight: bold">Página de Facebook</span></label> {{$d->fb}}<br>
                                        <a class="btn btn-info" href="#modificar_empresa">Modificar datos y logo de la empresa</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="speaker ftco-animate speaker-1 align-items-center">
                                <div class="text pl-4" style="text-align: center">
                                    <h4 style="text-align: center">Mapa de sucursales</h4>
                                    <div style="width: 100%; height: 300px" id="sucursales-map"></div>
                                    <a class="btn btn-info" href="#modificar_sucursal">Agregar/Modificar sucursales</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- PAGINA PRINCIPAL-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
                <h2 class="mb-1" id="modificar_empresa">Modificar datos de la empresa</h2>
            </div>
        </div>
        <form class="bg-light" id="my_form" method="POST" action="{{ route('guardar-empresa') }}" enctype="multipart/form-data">
            <input type="hidden" name="solicitud" value="{{$d->id_solicitud}}">
            {{ csrf_field() }}
            <div class="row">
            <div class="form-group col-md-4">
                <label for="nombre_empresa">Nombre de la Empresa</label>
                <input type="text" readonly class="form-control-plaintext" value="{{Auth::user()->nombre_empresa}}" placeholder="Nombre de la empresa">
            </div>
            <div class="form-group col-md-4">
                <label for="nit">NIT</label>
                <input type="text" readonly class="form-control-plaintext" value="{{Auth::user()->nit}}" placeholder="NIT">
            </div>
            <div class="form-group col-md-4">
                <label for="direccion">Dirección de la Empresa</label>
                <input type="text" id="direccion" required name="direccion" class="form-control" value="{{ null!==(old('direccion')) ? old('direccion') : Auth::user()->direccion}}" placeholder="Dirección de la empresa">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="telefono">Teléfono de contacto de la Empresa</label>
                <input type="text" id="telefono" required name="telefono" class="form-control" value="{{ null!==(old('telefono')) ? old('telefono') : Auth::user()->telefono}}" placeholder="Teléfono de la empresa">
            </div>
            <div class="form-group col-md-4">
                <label for="email">Correo Electrónico de la Empresa</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ null!==(old('email')) ? old('email') : Auth::user()->email}}" placeholder="contacto@tu-empresa.com">
            </div>
            <div class="form-group col-md-4">
                <label for="web">Página web</label>
                <input type="text" id="web" name="web" class="form-control" value="{{ null!==(old('web')) ? old('web') : Auth::user()->web}}" placeholder="www.tuempresa.com">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="descripcion">Descripción de la Empresa (máximo 150 caracteres)</label>
                <textarea id="descripcion" name="descripcion" required class="form-control" maxlength=150 placeholder="Descripción de la empresa">{{ null!==(old('descripcion')) ? old('descripcion') : $d->descripcion}}</textarea>
            </div>
            <div class="form-group col-md-4">
                <label for="pais">País</label>
                <select id="pais" name="pais" required class="form-control" placeholder="Elija el país">
                    @foreach ($paises as $p)
                        <option value="{{$p->id}}" {{ (null!==old("pais") ? (old("pais") == $p->id ? 'selected' : '') : (Auth::user()->pais==$p->id ? 'selected' : '')) }}>{{$p->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="ciudad">Ciudad</label>
                <select id="ciudad" name="ciudad" required class="form-control" placeholder="Elija la ciudad">
                    @if(null===old('cita'))
                        @foreach ($ciudades as $c)
                            <option value="{{$c->id}}" {{ (null!==old("ciudad") ? (old("ciudad") == $c->id ? 'selected' : '') : (Auth::user()->ciudad==$c->id ? 'selected' : '')) }}>{{$c->nombre}}</option>
                        @endforeach
                    @else
                        @foreach (old('cita') as $c)
                            <option value="{{$c->id}}" {{ (null!==old("ciudad") ? (old("ciudad") == $c->id ? 'selected' : '') : (Auth::user()->ciudad==$c->id ? 'selected' : '')) }}>{{$c->nombre}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nombre_responsable">Persona de contacto</label>
                <input type="text" id="nombre_responsable" required name="nombre_responsable" class="form-control" value="{{ null!==(old('nombre_responsable')) ? old('nombre_responsable') : Auth::user()->nombre_responsable}}" placeholder="Persona de contacto de la empresa">
            </div>
            <div class="form-group col-md-4">
                <label for="telefono_responsable">Teléfono de contacto del Responsable</label>
                <input type="text" id="telefono_responsable" required name="telefono_responsable" class="form-control" value="{{ null!==(old('telefono_responsable')) ? old('telefono_responsable') : Auth::user()->telefono_responsable}}" placeholder="Teléfono de la empresa">
            </div>
            <div class="form-group col-md-4">
                <label for="email_representante">Email de la persona de contacto</label>
                <input type="text" id="email_representante" required name="email_representante" class="form-control" value="{{ null!==(old('email_representante')) ? old('email_representante') : Auth::user()->email_representante}}" placeholder="Persona de contacto de la empresa">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="wpp">Número de Whatsapp</label>
                <input type="text" id="wpp" name="wpp" class="form-control" value="{{ null!==(old('wpp')) ? old('wpp') : $d->wpp}}" placeholder="Número con Whatsapp para pedidos">
            </div>
            <div class="form-group col-md-4">
                <label for="ig">Página de Instagram</label>
                <input type="text" id="ig" name="ig" class="form-control" value="{{ null!==(old('ig')) ? old('ig') : $d->ig}}" placeholder="www.instagram.com/tu-página">
            </div>
            <div class="form-group col-md-4">
                <label for="fb">Página de Facebook</label>
                <input type="text" id="fb" name="fb" class="form-control" value="{{ null!==(old('fb')) ? old('fb') : $d->fb}}" placeholder="www.facebook.com/tu-página">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="video">Video de Presentación</label>
                <input type="text" id="video" name="video" class="form-control" value="{{ null!==(old('video')) ? old('video') : $d->video}}" placeholder="Link al video de YouTube, Vimeo o Facebook">
            </div>
            <div class="form-group col-md-4">
                <label for="logo">Logo</label>
                <input id="logo" type="file" class="form-control" accept="image/*" name="logo">
                <strong>El peso máximo del logo es de 2MB</strong>
                <img src="{{file_exists(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa.'.jpg') ? url('https://expositores.feicobol.com.bo/images/logos/'.Auth::user()->id_empresa.'.jpg') : url('https://expositores.feicobol.com.bo/images/logos/suba_su_logo.png')}}" style="width:100%" />
            </div>
        </div>
        <div class="row" style="justify-content: center">
            <button id="boton_md" type="submit" class="btn btn-primary">
                <span id="md_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="md_enviar">Guardar Modificaciones</span>
            </button>
        </div>
        </form>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
                <h2 class="mb-1" id="modificar_sucursal">Agregar y Modificar Sucursales</h2>
            </div>
        </div>
        <form class="bg-light" id="my_form2" method="POST" action="{{ route('guardar-sucursales') }}">
        {{ csrf_field() }}
        <div class="row">
        <div class="col-md-2">
        @foreach ($sucs as $i=>$s)
            @if($i==0)
            <h4>Sucursales actuales</h4>
            @endif
            Sucursal {{$i+1}}: {{$s->address}} <button type="button" class="btn btn-success" onclick="mostrar_sucursal('{{$s->id_sucursal}}','{{$s->lat}}','{{$s->lon}}','{{$s->address}}','{{$s->caracteristicas}}')"><ion-icon name="pencil-sharp"></ion-icon></button><a onclick="return confirm('Está seguro que desea eliminar la sucursal {{$i+1}}: {{$s->address}}?')" href="{{route('eliminar-sucursal', $s->id_sucursal)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
        @endforeach
        </div>
        <div class="col-md-6">
            <div class="form-group" >
                <label for="direccion_sucursal" class="control-label">Ubicación:</label>
            <div class="col-md-9">
                <input type="text" class="form-control" required name="direccion_sucursal" id="direccion_sucursal" value="{{Auth::user()->address}}" />
            </div>
            </div>
            <div class="form-group">
                <label for="caracteristicas" class="control-label">Características de este lugar:</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="caracteristicas" id="caracteristicas" ></textarea>
                <span style="font-size:smaller">Puedes colocar si este lugar vende al por mayor, solo al detalle, o alguna característica de ubicación (puerta color rojo, al frente del parque, etc)</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" style="height:350px;">
            <input type="hidden" name="identificador" id="identificador" value="N" />
            <input type="hidden" name="lat" id="lat" value="{{Auth::user()->lat}}" />
            <input type="hidden" name="lon" id="lon" value="{{Auth::user()->lon}}" />
            <div style="width: 100%; height: 70%" id="address-map"></div>
            <span style="font-size:smaller">Puedes arrastrar la flechita azul hasta la ubicación de tu tienda/oficina, o puedes buscarla en el mapa y hacer clic en la ubicación</span>
            </div>
        </div>
    </div>
        <div class="row" style="justify-content: center">
            <button id="boton_ms" type="submit" class="btn btn-primary">
                <span id="ms_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="ms_enviar">Guardar Sucursal</span>
            </button>&nbsp;
            <button id="boton_ms_deshacer" type="reset" class="btn btn-danger">
                Deshacer cambios
            </button>
        </div>
        </form>
    </div>
</section>
  @endsection
@section('head_scripts')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

@endsection
@section('scripts')
<script src="{{asset('/js/mapa.js?1')}}"></script>
<script>
    var tilelay=L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://cloudmade.com">CloudMade</a>',
        maxZoom: 18
        });
    var sucursalesmap = L.map('sucursales-map',    {
        zoomControl: true,
        layers:tilelay,
        maxZoom: 18,
        minZoom: 6
      }).setView([parseFloat({{Auth::user()->lat}}),parseFloat({{Auth::user()->lon}})], 13);
      var mark = L.marker([{{Auth::user()->lat}},{{Auth::user()->lon}}]).addTo(sucursalesmap);
      @foreach($sucs as $s)
        var mark = L.marker([{{$s->lat}},{{$s->lon}}]).addTo(sucursalesmap);
      @endforeach
function mostrar_sucursal(id,lat,lon,add,caract){
    $('#identificador').val(id);
    $('#lat').val(lat);
    $('#lon').val(lon);
    $('#direccion_sucursal').val(add);
    $('#caracteristicas').val(caract.replace('<br />','\n'));
    mymap.setView([lat,lon],15);
    marker.setLatLng(new L.LatLng(lat,lon),{draggable:'true'}).bindPopup(new L.LatLng(lat,lon)).update();
    setTimeout(function () { mymap.invalidateSize();}, 500);
}      
$(document).ready( function () {
    $('#my_form2').on('reset',function(){
        $('#identificador').val('N');
        $('#lat').val(-17.3930281);
        $('#lon').val(-66.1523097);
        mymap.setView([-17.3930281,-66.1523097],15);
        marker.setLatLng(new L.LatLng(-17.3930281,-66.1523097),{draggable:'true'}).bindPopup(new L.LatLng(-17.3930281,-66.1523097)).update();
        setTimeout(function () { mymap.invalidateSize();}, 500);
    });
    $('#my_form').on('submit',function(){
        $('#md_carga').css('display','block');
        $('#md_enviar').css('display','none');
        $('#boton_md').prop('disabled', true);
    });
    $('#my_form2').on('submit',function(){
        $('#ms_carga').css('display','block');
        $('#ms_enviar').css('display','none');
        $('#boton_ms').prop('disabled', true);
    });
    $('#pais').change(function(){
        var busqueda=$('#pais').val();
        if(busqueda)
        {
            $.ajax({
                type: "POST",
                url: "{{URL::to('api/buscar_ciudad')}}",
                data: {'_token': $('[name=_token]').val(),'search':busqueda},
                success:function(data){
//                    alert(data);
                    if(data!==null){
                        $('#ciudad').empty();
                        $('#ciudad').append('<option disabled="true">=== Elegir Ciudad ===</option>');
                        $.each(data,function(i,ciudad){
                            $('#ciudad').append('<option value="'+ciudad.id+'">'+ciudad.nombre+'</option>');
                        });
                    }
                }
            });
        }
    });
    $("#logo").on('change',function(){
        var sizeFoto = $(this).get(0).files[0].size;
        if (sizeFoto > 2097152) {
          alert('Error: No se puede subir logos de más de 2 MB.');
          $(this).val('');
        }    
    });
});
</script>
@endsection
