@extends('layouts.app',['vals'=>true])

@section('content')
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="title_text title_text2 ">
                            <h3>Sé parte de la feria</h3>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        @if(date('Y-m-d H:i:s')>'2020-09-28 00:00:00')
                            <div class="title_text title_text2 ">
                                <h3>Lamentablemente, la fecha límite de registro ya fue superada.</h3>
                            </div>
                        @else
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <span style="color: white">Para poder participar de la feria, debe llenar el siguiente formulario con los datos correspondientes</span>
                                    <form id="my_form" class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('nombre_empresa') ? ' has-error' : '' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="nombre_empresa" class="col-md-10 control-label">Nombre de la empresa</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-building" aria-hidden="true"></i></div>
                                                        <input id="nombre_empresa" type="text" class="single-input" name="nombre_empresa" value="{{ old('nombre_empresa') }}" required autofocus>
                                                        @if ($errors->has('nombre_empresa'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('nombre_empresa') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>        
                                                </div>
                                                <div class="col-md-4">
                                                    <label  for="nit" class="col-md-10 control-label">Nit de la empresa</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-wpforms" aria-hidden="true"></i></div>
                                                        <input id="nit" type="number" min="99999" class="single-input" name="nit" value="{{ old('nit') }}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label  for="nombre_responsable" class="col-md-10 control-label">Nombres y apellidos de la persona a quien contactaremos</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                                        <input id="nombre_responsable" type="text" class="single-input" name="nombre_responsable" value="{{ old('nombre_responsable') }}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label  for="telefono" class="col-md-10 control-label">Telefono o Celular de contacto</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                                        <input id="telefono" type="text" class="single-input" name="telefono" value="{{ old('telefono') }}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-4">
                                                    <label for="email" class="col-md-10 control-label">Correo Electrónico</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                                        <input id="email" type="email" class="single-input" name="email" value="{{ old('email') }}" required>
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="tipo" class="col-md-10 control-label">Qué tipo de stand desea</label>
                                                    <div class="input-group-icon mt-10">
                                                        <select id="tipo" class="form-select" name="tipo" onchange="mostrar()">
                                                            <option value="350" selected>Emprendedor</option>
                                                            <option value="500">Regular</option>
                                                            <option value="700">Completo</option>
                                                        </select>
                                                    </div>        
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="encuentro" class="col-md-10 control-label">Desea participar del Encuentro de Negocios Virtual? (No tiene costo adicional):</label>
                                                    <div class="input-group-icon mt-10"> 
                                                        <div class="radio">
                                                        <label><input type="radio" name="encuentro" value="0" checked>No</label>
                                                        </div>
                                                        <div class="radio">
                                                        <label><input type="radio" name="encuentro" value="1" >Si</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="cantidad" class="col-md-10 control-label">Cantidad de Stands que desea:</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-hashtag" aria-hidden="true"></i></div>
                                                        <input id="cantidad" type="number" min="1" max="33" step="1" class="single-input" name="cantidad" value="{{ old('cantidad') }}" onchange="mostrar()" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @for($i=1;$i<=11;$i++)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4" id="stand_{{($i*3)-2}}">
                                                    <label for="nombre_stand_{{($i*3)-2}}" class="col-md-10 control-label">A qué marca/empresa corresponde el stand {{($i*3)-2}}?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-hashtag" aria-hidden="true"></i></div>
                                                        <input id="nombre_stand_{{($i*3)-2}}" type="text" class="single-input" name="nombre_stand[]" value="{{ old('nombre_stand.'.($i*3)-2) }}" required autofocus>
                                                    </div>
                                                    <label for="productos_{{($i*3)-2}}" class="col-md-10 control-label">Qué productos desea exponer en el stand?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-store" aria-hidden="true"></i></div>
                                                        <textarea id="productos_{{($i*3)-2}}" type="text" class="single-textarea" name="productos[]" required autofocus>{{ old('productos.'.($i*3)-2) }}</textarea>
                                                    </div>        
                                                </div>
                                                <div class="col-md-4" id="stand_{{($i*3)-1}}">
                                                    <label for="nombre_stand_{{($i*3)-1}}" class="col-md-10 control-label">A qué marca/empresa corresponde el stand {{($i*3)-1}}?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-hashtag" aria-hidden="true"></i></div>
                                                        <input id="nombre_stand_{{($i*3)-1}}" type="text" class="single-input" name="nombre_stand[]" value="{{ old('nombre_stand.'.($i*3)-1) }}" required autofocus>
                                                    </div>
                                                    <label for="productos_{{($i*3)-1}}" class="col-md-10 control-label">Qué productos desea exponer en el stand?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-store" aria-hidden="true"></i></div>
                                                        <textarea id="productos_{{($i*3)-1}}" type="text" class="single-textarea" name="productos[]" required autofocus>{{ old('productos.'.($i*3)-1) }}</textarea>
                                                    </div>        
                                                </div>
                                                <div class="col-md-4" id="stand_{{($i*3)}}">
                                                    <label for="nombre_stand_{{($i*3)}}" class="col-md-10 control-label">A qué marca/empresa corresponde el stand {{($i*3)}}?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-hashtag" aria-hidden="true"></i></div>
                                                        <input id="nombre_stand_{{($i*3)}}" type="text" class="single-input" name="nombre_stand[]" value="{{ old('nombre_stand.'.($i*3)) }}" required autofocus>
                                                    </div>
                                                    <label for="productos_{{($i*3)}}" class="col-md-10 control-label">Qué productos desea exponer en el stand?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-store" aria-hidden="true"></i></div>
                                                        <textarea id="productos_{{($i*3)}}" type="text" class="single-textarea" name="productos[]" required autofocus>{{ old('productos.'.($i*3)) }}</textarea>
                                                    </div>        
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="panel panel-default col-md-12" style="margin: 15px">
                                                    <div class="panel-heading" style="text-align: center"><h4 style="color: white">TÉRMINOS Y CONDICIONES REACTIVA BOLIVIA 2020</h4></div>
                                                    <div class="panel-body" style="color: white;overflow-y:scroll;height:400px;text-align:justify;border:solid;padding:5px">
                                                        1. CONDICIONES GENERALES<br>
                                                        FEICOBOL, tiene como objeto el de lograr la expansión de mercados y el intercambio de experiencias comerciales y técnicas por parte de los diferentes agentes económicos; así como constituirse en el mayor instrumento organizado para lograr un crecimiento económico, viabilizando la inversión.<br>
                                                        Bajo este contexto, se suscribe el presente documento de términos y condiciones para la participación en la REACTIVA BOLIVIA 2020, que se realizará del 17 al 23 de Septiembre del 2020, EXCLUSIVAMENTE para la exposición de los productos, mercaderías y servicios de los rubros: Alimentos procesados, Alimentos para animales, Artesanías, Bebidas, Cárnicos, Construcción, Cuero, Madera, Metalmecánica, Panadería, agropecuarios, de recreación, eléctricos/electrónicos, farmaceuticos, limpieza y otros mediante la plataforma de internet (en adelante, "reactivaproductiva.feicobol.com"), espacio en el que se ofrecerá la información general a los usuarios y permitirá establecer contactos tanto entre los usuarios y los expositores. Además se podrá obtener información sobre cada expositor en la Feria Virtual, siempre que la feria correspondiente ofrezca esta posibilidad.<br>
                                                        2. INSCRIPCIÓN<br>
                                                        Deberá llenarse el registro de participación, ajustándose a las formas de pago que aparecen en el mismo. En caso de no realizarse el pago en los plazos establecidos, el expositor perderá todos los derechos sobre el espacio reservado, pasando dicho espacio a disposición de FEICOBOL.<br>
                                                        No se autorizará la ocupación del espacio que no haya sido cancelado.<br>
                                                        3. MONTO Y FORMA DE PAGO<br>
                                                        El monto establecido por participación en la REACTIVA BOLIVIA 2020, es de Bs. <span id="monto">350</span>,00 (<span id="monto_literal">Trescientos Cincuenta</span> 00/100 bolivianos) los mismos que deberán ser cancelados hasta el 16/09/2020 impostergablemente, a las siguientes cuentas bancarias:<br>
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
                                                        A favor de la FUNDACIÓN PARA LA FERIA INTERNACIONAL DE COCHABAMBA o simplemente FEICOBOL<br>
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
                                                        FEICOBOL podrá establecer nuevas disposiciones impuestas por las circunstancias para la buena marcha de la exposición, dándolas a conocer a los expositores, asimismo FEICOBOL deberá aprobar los productos que los EXPOSITORES quieran promocionar en la FERIA VIRTUAL.<br>
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
                                                <div class="col-md-4">
                                                    <label for="nit" class="col-md-10 control-label">Está de acuerdo con los Términos y condiciones?</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="checkbox" style="text-align: center; flex:auto;inline-size:-webkit-fill-available">
                                                            <label><input type="checkbox" id="aceptacion" name="aceptacion" class="mr-2" required> Acepto los Términos y Condiciones</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nit_factura" class="col-md-10 control-label">NIT para la factura</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-wpforms" aria-hidden="true"></i></div>
                                                        <input id="nit_factura" type="number" class="single-input" min="99999" name="nit_factura" value="{{ old('nit_factura') }}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="razon_social" class="col-md-10 control-label">Razón Social para la factura</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-wpforms" aria-hidden="true"></i></div>
                                                        <input id="razon_social" type="text" class="single-input" name="razon_social" value="{{ old('razon_social') }}" required autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label  for="password" class="col-md-10 control-label">Contraseña para la cuenta</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                                                        <input id="password" type="password" class="single-input" name="password" required>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="password-confirm"  class="col-md-10 control-label">Repita su contraseña</label>
                                                    <div class="input-group-icon mt-10">
                                                        <div class="icon"><i class="fa fa-key" aria-hidden="true"></i></div>
                                                        <input id="password-confirm" type="password" class="single-input" name="password_confirmation" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {!! NoCaptcha::display() !!}
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-7 col-md-offset-7">
                                                <button id="boton" type="submit" class="genric-btn success circle arrow">
                                                    <span id="boton_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="boton_enviar">Finaliza tu registro</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! NoCaptcha::renderJs() !!}
<script>
    function Unidades(num){

        switch(num)
        {
            case 1: return "UN";
            case 2: return "DOS";
            case 3: return "TRES";
            case 4: return "CUATRO";
            case 5: return "CINCO";
            case 6: return "SEIS";
            case 7: return "SIETE";
            case 8: return "OCHO";
            case 9: return "NUEVE";
        }
    
        return "";
    }//Unidades()
    
    function Decenas(num){
    
        decena = Math.floor(num/10);
        unidad = num-(decena * 10);
    
        switch(decena)
        {
            case 1:
                switch(unidad)
                {
                    case 0: return "DIEZ";
                    case 1: return "ONCE";
                    case 2: return "DOCE";
                    case 3: return "TRECE";
                    case 4: return "CATORCE";
                    case 5: return "QUINCE";
                    default: return "DIECI" + Unidades(unidad);
                }
            case 2:
                switch(unidad)
                {
                    case 0: return "VEINTE";
                    default: return "VEINTI" + Unidades(unidad);
                }
            case 3: return DecenasY("TREINTA", unidad);
            case 4: return DecenasY("CUARENTA", unidad);
            case 5: return DecenasY("CINCUENTA", unidad);
            case 6: return DecenasY("SESENTA", unidad);
            case 7: return DecenasY("SETENTA", unidad);
            case 8: return DecenasY("OCHENTA", unidad);
            case 9: return DecenasY("NOVENTA", unidad);
            case 0: return Unidades(unidad);
        }
    }//Unidades()
    
    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
        return strSin + " Y " + Unidades(numUnidades)
    
        return strSin;
    }//DecenasY()
    
    function Centenas(num) {
        centenas = Math.floor(num / 100);
        decenas = num - (centenas * 100);
    
        switch(centenas)
        {
            case 1:
                if (decenas > 0)
                    return "CIENTO " + Decenas(decenas);
                return "CIEN";
            case 2: return "DOSCIENTOS " + Decenas(decenas);
            case 3: return "TRESCIENTOS " + Decenas(decenas);
            case 4: return "CUATROCIENTOS " + Decenas(decenas);
            case 5: return "QUINIENTOS " + Decenas(decenas);
            case 6: return "SEISCIENTOS " + Decenas(decenas);
            case 7: return "SETECIENTOS " + Decenas(decenas);
            case 8: return "OCHOCIENTOS " + Decenas(decenas);
            case 9: return "NOVECIENTOS " + Decenas(decenas);
        }
    
        return Decenas(decenas);
    }//Centenas()
    
    function Seccion(num, divisor, strSingular, strPlural) {
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        letras = "";
    
        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + " " + strPlural;
            else
                letras = strSingular;
    
        if (resto > 0)
            letras += "";
    
        return letras;
    }//Seccion()
    
    function Miles(num) {
        divisor = 1000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        strMiles = Seccion(num, divisor, "UN MIL", "MIL");
        strCentenas = Centenas(resto);
    
        if(strMiles == "")
            return strCentenas;
    
        return strMiles + " " + strCentenas;
    }//Miles()
    
    function Millones(num) {
        divisor = 1000000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        strMillones = Seccion(num, divisor, "UN MILLON DE", "MILLONES DE");
        strMiles = Miles(resto);
    
        if(strMillones == "")
            return strMiles;
    
        return strMillones + " " + strMiles;
    }//Millones()
    
    function NumeroALetras(num) {
        var data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: "",
            letrasMonedaPlural: '',//"PESOS", 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: '', //"PESO", 'Dólar', 'Bolivar', 'etc'
    
            letrasMonedaCentavoPlural: "CENTAVOS",
            letrasMonedaCentavoSingular: "CENTAVO"
        };
    
        if (data.centavos > 0) {
            data.letrasCentavos = "CON " + (function (){
                if (data.centavos == 1)
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
                else
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
                })();
        };
    
        if(data.enteros == 0)
            return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
        else
            return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
    }
function mostrar(){
    var montos=["","350","500","700"];
    cant=$('#cantidad').val();
    if(cant<=0)
        cant=1;
    $('#cantidad').val(cant);
    $('#monto').html($('#tipo').val()*cant);
    $('#monto_literal').html(NumeroALetras($('#tipo').val()*cant));
    for(i=1;i<=cant;i++)
        {
        $('#stand_'+i).show();
        $('#nombre_stand_'+i).prop('required',true);
        $('#productos_'+i).prop('required',true);
        }
    for(i=((cant*1)+1);i<=33;i++)
        {
        $('#stand_'+i).hide();
        $('#nombre_stand_'+i).removeAttr('required');
        $('#productos_'+i).removeAttr('required');
        }
}
$(document).ready(function() {
    mostrar();
    $('#my_form').on('submit', function(e) {
        $('#boton_carga').css('display','block');
        $('#boton_enviar').css('display','none');
        $('#boton').prop('disabled', true);
    });
});</script>
@endsection
@section('head_scripts')
<style>
    label{
        color: white;
        font-weight: bold;
    }
</style>
@endsection