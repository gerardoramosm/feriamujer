@extends('layouts.appFV',['menu'=>$menu])
@section('content')
<div class="alert alert-danger">
    @if (!isset($pago))
        No olvide subir el comprobante de pago de su participación en el evento para poder registrar los productos y ofertas del stand.
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
    @else
        @foreach($pago as $p)
            @if($p->estado==2)
                El comprobante de pago no es legible o corresponde al evento actual, por favor suba otra imagen del comprobante de pago.
            @else
                El pago todavía no ha sido verificado por el Departamento de Administración y Finanzas, por favor aguarde la confirmación que le llegará al correo electrónico.
            @endif
        @endforeach
    @endif
</div>
<form class="" id="my_form" method="POST" action="{{ route('pago') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id_solicitud" value="{{$sol->id_solicitud}}">
    <div class="container">
        <div class="row">
            <div class="{{isset($pago) ? 'col-md-8' : 'col-md-12'}}">
                <div class="panel panel-default ">
                    <div class="panel-body p-3 ">
                        <h2>Comprobante de pago</h2>
                        <span>Por favor ingrese los datos del comprobante de pago de Bs. {{$sol->precio}}</span>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="monto">Monto del comprobante</label>
                                <input type="number" min="1" max="{{$sol->precio}}" name="monto" class="form-control" value="{{ old('monto') }}" placeholder="Monto en Bs." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="obs">Observaciones/Aclaraciones/Comentarios</label>
                                <textarea class="form-control" name="obs" placeholder="Ej: Comprobante de Pago de 2 empresas, etc."> {{ old('obs')}} </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="foto">Subir Foto/Imagen del comprobante</label>
                                <input type="file" name="foto" required class="form-control" value="{{ old('foto') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <button id="boton" type="submit" class="btn btn-primary">
                                    <span id="boton_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="boton_enviar">Enviar comprobante de pago</span>
                                </button>
                            </div>
                        </div>
                        <!-- FORMULARIO PARA SUBIDA DE PAGO Y SI HAY PAGO, DETALLES DE PAGO SUBIDO-->
                    </div>
                </div>
            </div>
            @if(isset($pago))
            <div class="col-md-4">
                <div class="panel panel-default ">
                    <div class="panel-body bg-light p-3 ">
                        <h2>Pagos reportados</h2>
                        <table class="table table-info">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pago as $p)
                                <tr>
                                    <td>{{$p->fecha}}</td>
                                    <td>{{$p->monto}}</td>
                                    <td>{{$p->estado==0 ? 'Pendiente' : 'Aprobado'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- FORMULARIO PARA SUBIDA DE PAGO Y SI HAY PAGO, DETALLES DE PAGO SUBIDO-->
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </form>
    @endsection
    @section('scripts')
<script>
$(document).ready(function() {
    $('#my_form').on('submit', function(e) {
        $('#boton_carga').css('display','block');
        $('#boton_enviar').css('display','none');
        $('#boton').prop('disabled', true);
    });
});</script>
@endsection
