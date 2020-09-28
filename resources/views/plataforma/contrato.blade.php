@extends('layouts.appFV',['menu'=>$menu,'clase'=>1])
@section('content')
@if (!old('aceptacion'))
<div class="alert alert-danger">
    Debe llenar los datos y leer y aceptar los Términos y Condiciones para poder participar de la Feria.
</div>
@endif
<form class="" id="my_form" method="POST" action="{{ route('contrato') }}">
{{ csrf_field() }}
<input type="hidden" name="id_solicitud" value="{{$sol->id_solicitud}}">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default ">
                <div class="panel-body bg-light p-3 ">
                    <h2>Datos para la factura</h2>
                    <span>Por favor ingrese los datos para la factura</span>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="razon_social">Razón Social</label>
                            <input type="text" name="razon_social" class="form-control" value="{{ null!==(old('razon_social')) ? old('razon_social') : $sol->razon_social}}" placeholder="Razón Social" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nit_factura">NIT</label>
                            <input type="text" class="form-control" name="nit_factura" value="{{ null!==(old('nit_factura')) ? old('nit_factura') : $sol->nit_factura}}" placeholder="NIT" required>
                        </div>
                    </div>
                    <h2>Datos para el Contrato</h2>
                    <span>Por favor ingrese los datos para el contrato</span>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nombre_empresa">Nombre de la Empresa</label>
                            <input type="text" readonly class="form-control" value="{{Auth::user()->nombre_empresa}}" placeholder="Nombre de la empresa">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nit">NIT</label>
                            <input type="text" readonly class="form-control" value="{{Auth::user()->nit}}" placeholder="NIT">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección de la Empresa</label>
                            <input type="text" id="direccion" required name="direccion" class="form-control" value="{{ null!==(old('direccion')) ? old('direccion') : Auth::user()->direccion}}" placeholder="Dirección de la empresa">
                        </div>                    
                        <div class="form-group col-md-6">
                            <label for="telefono">Teléfono de contacto de la Empresa</label>
                            <input type="text" id="telefono" required name="telefono" class="form-control" value="{{ null!==(old('telefono')) ? old('telefono') : Auth::user()->telefono}}" placeholder="Teléfono de la empresa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pais">País</label>
                            <select id="pais" name="pais" required class="form-control" placeholder="Elija el país">
                                @foreach ($paises as $p)
                                    <option value="{{$p->id}}" {{ (null!==old("pais") ? (old("pais") == $p->id ? 'selected' : '') : (Auth::user()->pais==$p->id ? 'selected' : '')) }}>{{$p->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
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
                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripción de la Empresa (máximo 150 caracteres)</label>
                            <textarea id="descripcion" name="descripcion" required class="form-control" maxlength=150 placeholder="Descripción de la empresa">{{ null!==(old('descripcion')) ? old('descripcion') : $sol->descripcion}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Correo Electrónico de la Empresa</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ null!==(old('emaild')) ? old('email') : Auth::user()->email}}" placeholder="contacto@tu-empresa.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="web">Página web</label>
                            <input type="text" id="web" name="web" class="form-control" value="{{ null!==(old('web')) ? old('web') : Auth::user()->web}}" placeholder="www.tuempresa.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="wpp">Número de Whatsapp</label>
                            <input type="text" id="wpp" name="wpp" class="form-control" value="{{ null!==(old('wpp')) ? old('wpp') : $sol->wpp}}" placeholder="Número con Whatsapp para pedidos">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ig">Página de Instagram</label>
                            <input type="text" id="ig" name="ig" class="form-control" value="{{ null!==(old('ig')) ? old('ig') : $sol->ig}}" placeholder="www.instagram.com/tu-página">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fb">Página de Facebook</label>
                            <input type="text" id="fb" name="fb" class="form-control" value="{{ null!==(old('fb')) ? old('fb') : $sol->fb}}" placeholder="www.facebook.com/tu-página">
                        </div>
                    </div>
                    <div class="row" style="height: 250px;margin-right:0px !important;margin-left:0px !important">
                        <div class="form-group">
                            <label for="address-map">Ubicación del lugar</label>
                            <input type="hidden" name="lat" id="lat" value="{{ Auth::user()->lat}}" />
                            <input type="hidden" name="lon" id="lon" value="{{ Auth::user()->lon}}" />
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $montos=array("",450,900,1350,1800,2250,2700,3150,3600,4050,4500,4950,5400,5850,6300,6750,7200,7650,8100,8550,9000);
            $montos_l=array("","Cuatrocientos cincuenta","Novecientos","Un mil trescientos cincuenta","Un mil ochocientos","Dos mil Doscientos cincuenta","Dos mil Setecientos","Tres mil Ciento cincuenta","Tres mil Seiscientos","Cuatro mil cincuenta","Cuatro mil Quinientos","Cuatro mil Novecientos cincuenta","Cinco mil Cuatrocientos","Cinco mil Ochocientos cincuenta","Sesenta mil Trescientos","Sesenta mil Setecientos cincuenta","Siete mil Doscientos","Siete mil Seiscientos cincuenta","Ocho mil Cien","Ocho mil Quinientos cincuenta","Nueve mil");
        @endphp
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center"><h4>TÉRMINOS Y CONDICIONES FEXPO SALUD VIRTUAL 2020</h4></div>
                <div class="panel-body" style="overflow-y:scroll;height:900px;text-align:justify">
                    1. CONDICIONES GENERALES<br>
                    FEICOBOL, tiene como objeto el de lograr la expansión de mercados y el intercambio de experiencias comerciales y técnicas por parte de los diferentes agentes económicos; así como constituirse en el mayor instrumento organizado para lograr un crecimiento económico, viabilizando la inversión.<br>
                    Bajo este contexto, se suscribe el presente documento de términos y condiciones para la participación en la FEXPO SALUD VIRTUAL 2020, que se realizará del 24 al 30 de julio del 2020, EXCLUSIVAMENTE para la exposición de los productos y mercaderías de los sectores de SALUD Y MEDICINA, BIENESTAR, ALIMENTACIÓN SALUDABLE, VIDA ACTIVA, BIOSEGURIDAD mediante la plataforma de internet (en adelante, "salud.feicobol.com.bo"), espacio en el que se ofrecerá la información general a los usuarios y permitirá establecer contactos tanto entre los usuarios y los expositores. Además se podrá obtener información sobre cada expositor en la Feria Virtual, siempre que la feria correspondiente ofrezca esta posibilidad.<br>
                    2. INSCRIPCIÓN<br>
                    Deberá llenarse el registro de participación, ajustándose a las formas de pago que aparecen en el mismo. En caso de no realizarse el pago en los plazos establecidos, el expositor perderá todos los derechos sobre el espacio reservado, pasando dicho espacio a disposición de FEICOBOL.<br>
                    No se autorizará la ocupación del espacio que no haya sido cancelado.<br>
                    3. MONTO Y FORMA DE PAGO<br>
                    El monto establecido por participación en la FEXPO SALUD VIRTUAL, es de Bs. {{$montos[$sol->stands]}},00 ({{$montos_l[$sol->stands]}} 00/100 bolivianos) los mismos que deberán ser cancelados hasta el 23/07/2020 impostergablemente, a las siguientes cuentas bancarias:<br>
                    <ul>
                        <li>BANCO MERCANTIL SANTA CRUZ</li>
                        <ul>
                            <li>Cuenta Corriente Nº 4010-092941 (Bolivianos)</li>
                        </ul>
                        <li>BANCO GANADERO</li>
                        <ul>
                            <li>Cuenta Corriente Nº 3041-018832 (Bolivianos)</li>
                        </ul>
                    </ul>
                    A favor de la FUNDACIÓN PARA LA FERIA INTERNACIONAL DE COCHABAMBA o simplemente FEICOBOL
                    4. PARTICIPANTES<br>
                    FEICOBOL, se reserva el derecho de admisión de las empresas participantes, en virtud a que las empresas deberán estar acorde al evento a realizarse pero además cumplir con requisitos legales mínimos de acreditación.<br>
                    5. DERECHOS SBRE LA FERIA VIRTUAL<br>
                    5.1 FEICOBOL, se reserva el derecho exclusivo a reproducir, distribuir o difundir públicamente la Feria Virtual de forma total o, según el tamaño o tipo, de forma parcial.<br>
                    5.2 El EXPOSITOR, no tiene derechos de autor, derechos de patente o derechos de uso sobre la Feria Virtual.<br>
                    6. PRESTACION DEL SERVICIO<br>
                    El EXPOSITOR, no tiene derecho a exigir el servicio de internet de FEICOBOL para subir sus productos a la plataforma que este le proporcione.<br>
                    Asimismo el EXPOSITOR no tiene derecho a exigir a FEICOBOL que la FERIA VIRTUAL se presente sin interrupciones, fallas, total o parcialmente, ya que FEICOBOL depende también de los proveedores de internet que otorgan el servicio.<br>
                    FEICOBOL no está obligada a informar a los EXPOSITORES y usuarios sobre las interrupciones que salgan fuera del alcance de su control.<br>
                    7.SUSPENSIÓN DEL PARTICIPANTE.<br>
                    FEICOBOL al tener derecho de admisión a las empresas participantes podrá revocar la presente autorización en caso de verificar que los datos otorgados por la empresa para el evento son inexactos o si las condiciones de admisión y participación no son cumplidas.<br>
                    FEICOBOL podrá establecer nuevas disposiciones impuestas por las circunstancias para la buena marcha de la exposición, dándolas a conocer a los expositores, asimismo FEICOBOL deberá aprobar los productos que los EXPOSITORES quieran promocionar en la FERIA VIIRTUAL.<br>
                    8. RENUNCIA DEL EXPOSITOR<br>
                    Si el participante por algún motivo no pudiese participar en el evento deberá comunicar en forma escrita tal hecho a FEICOBOL. En tal caso el expositor no podrá pedir la devolución del dinero abonado a la fecha del comunicado. Dicha situación de igual manera facilita a FEICOBOL a disponer del espacio de la manera que vea conveniente.<br>
                    9. DAÑOS Y PERJUICIOS<br>
                    Los daños o perjuicios causados a FEICOBOL por parte del EXPOSITOR ya sean morales, económicos o contra la imagen pública de FEICOBOL, miembros del Directorio, Directiva y/o personal administrativo, podrán dar lugar al inicio de acciones legales que correspondan por parte de FEICOBOL.<br>
                    10. USO DE PATENTES, MARCAS Y PRODUCTOS<br>
                    El EXPOSITOR, tendrá absoluta responsabilidad por problemas legales derivados de patentes y/o el uso no autorizado de marcas y productos en exposición.<br>
                    11. CAMBIO DE FECHAS<br>
                    FEICOBOL se reserva el derecho de cambiar si fuera necesario por causa justificada la fecha del evento, en cuyo caso el acuerdo de participación seguirá siendo válido quedando FEICOBOL eximida de toda responsabilidad civil o penal.<br>
                    12. SUSPENSIÓN DEL EVENTO<br>
                    Si por cualquier causa de fuerza mayor no pudiera celebrarse el evento, los expositores sólo tendrán derecho a la devolución del pago por participación  sin ninguna otra indemnización o recargo alguno.<br>
                    13. PROTECCION DE DATOS<br>
                    El uso de la información disponible de FEICOBOL conlleva el almacenamiento de datos del EXPOSITOR. El tratamiento de los datos de los EXPOSITORES sirve únicamente para permitir el uso de la información ofrecida. Los datos se borrarán inmediatamente después de la terminación de su uso. FEICOBOL no revelará esta información a terceros a menos que el EXPOSITOR lo haya consentido expresamente.<br>
                    14. ACEPTACIÓN EXPRESA.<br>
                    Yo, como representante de la empresa a la cual pertenezco y con la atribución de poder tomar cualquier tipo de decisiones declaro haber leído el texto del mismo en su totalidad y estoy de acuerdo con todas y cada una de las condiciones del presente documento para tal efecto le doy mi aceptación al presente como muestra de conformidad.
                </div>
            </div>
        </div>
        <div class="checkbox" style="text-align: center; flex:auto;inline-size:-webkit-fill-available">
            <label><input  type="checkbox" id="aceptacion" name="aceptacion" class="mr-2"> Acepto los Términos y Condiciones</label>
        </div><br>
        <div class="row" style="text-align: center;margin:auto">
        <button type="submit" class="btn btn-primary ">Guardar y Continuar</button>
        </div>
    </div>
</div>
</form>
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
<script src="{{asset('/js/mapa.js')}}"></script>
<script>
$(document).ready( function () {
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
});
</script>
@endsection
