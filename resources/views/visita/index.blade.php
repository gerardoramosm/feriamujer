@extends('layouts.appVisita',['mapa'=>false,'height'=>850,'height_desk'=>690])
@section('modal_confirm')
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <img src="{{asset('fv/images/programa5.jpg')}}" style="width: 100%">
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true"
    @desktop
        style="height:700px"
    @elsedesktop
        style="height: auto !important"
    @enddesktop >
        <div class="col-lg-5 col-md-7 mt-0 mt-md-6">
            <form class="request-form ftco-animate" id="my_form" method="POST" action="{{ route('mapa') }}">
            {{ csrf_field() }}
            <h2>Bienvenido!</h2>
            <span>Por favor regístrate para ingresar</span>
                <div class="form-group">
                    <label for="nombre">Tu Nombre</label>
                    <input type="text" name="nombre" class="form-control" required placeholder="Tu Nombre">
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" required placeholder="Tu Correo Electrónico">
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="edad">Tu Edad</label>
                        <input type="number" name="edad" min="8" max="99" step="1" required class="form-control" placeholder="Ingresa tu edad">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="genero">Género</label>
                        <br><input type="radio" name="genero" value="0" required>Femenino
                        <br><input type="radio" name="genero" value="1" >Masculino
                    </div>
                </div>
                <div class="form-group">
                    <span style="font-size: smaller">Al ingresar autorizas el uso de Cookies y Confirmas haber leído y aceptado nuestra <a href="#" data-toggle="modal" data-target="#politica">Política de Privacidad de Datos</a></span>
                    <button id="boton" type="submit"  class="btn btn-primary py-3 px-4">
                        <span id="boton_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Ingresando</span><span id="boton_enviar">Ingresar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="politica" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Política de Privacidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="padding:0">&times;</button>
            </div>
            <div class="modal-body">
                La presente Política de Privacidad establece los términos en que FEICOBOL usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.<br>
                <br><strong>Información que es recogida</strong><br>
                Nuestro sitio web podrá recoger información personal por ejemplo: Nombre, edad, información de contacto como su dirección de correo electrónica e información demográfica. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún pedido o realizar una entrega o facturación.<br>
                <br><strong>Uso de la información recogida</strong><br>
                Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios. Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con ofertas especiales, nuevos productos y otra información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.<br>
                FEICOBOL está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.<br>
                <br><strong>Cookies</strong><br>
                Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.<br>
                Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente. Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.<br>
                <br><strong>Enlaces a Terceros</strong><br>
                Este sitio web pudiera contener enlaces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.<br>
                <br><strong>Control de su información personal</strong><br>
                En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web. Cada vez que se le solicite rellenar un formulario, como el de alta de usuario, puede marcar o desmarcar la opción de recibir información por correo electrónico.  En caso de que haya marcado la opción de recibir nuestro boletín o publicidad usted puede cancelarla en cualquier momento.<br>
                FEICOBOL Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready( function () {
    $('#my_form').on('submit', function(e) {
        $('#boton_carga').css('display','block');
        $('#boton_enviar').css('display','none');
        $('#boton').prop('disabled', true);
    });
//    $("#myModal").modal('show');
});
</script>
@endsection
