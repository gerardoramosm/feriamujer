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
            <div class="col-md-12">
                <div class="panel panel-default ">
                    <div class="panel-body p-3 ">
                        <h2 style="text-align: center">Listado de Ofertas {{(isset($sel)) ? "del stand ".$st->nombre : "de ".Auth::user()->nombre_empresa}}</h2>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="speaker ftco-animate speaker-1 align-items-center">
                                <div class="text pl-4" style="text-align: center">
                                    <h4 style="text-align: center">
                                        @if(count($ofertas)==0)
                                            Usted no tiene ofertas registradas
                                        </h4>
                                        <a class="btn btn-info" href="#modificar_ofertas">Registrar Ofertas</a>
                                        @else
                                            Usted tiene {{count($ofertas)}} ofertas registradas
                                        </h4>
                                        <a class="btn btn-info" href="#modificar_ofertas">Modificar Ofertas</a>
                                        @endif
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
                <h2 class="mb-1" id="modificar_ofertas">Agregar y Modificar Ofertas</h2>
            </div>
        </div>
        @if(isset($sel))
            <form class="bg-light" id="my_form2" method="POST" action="{{ route('guardar-ofertas-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
        @else
            <form class="bg-light" id="my_form2" method="POST" action="{{ route('guardar-ofertas') }}" enctype="multipart/form-data">
        @endif
        <input type="hidden" name="id_oferta" id="id_oferta" value="N">
        {{ csrf_field() }}
        <div class="row">
        <div class="col-md-3">
        @foreach ($ofertas as $i=>$o)
            @if($i==0)
            <h4>Ofertas actuales</h4>
            @endif
            <button type="button" class="btn btn-info" onclick="mostrar_oferta('{{$o->id_oferta}}','{{$o->nombre_oferta}}','{{$o->detalle_oferta}}','{{$o->productos}}')">Oferta {{$i+1}}: {{$o->nombre_oferta}}</button><a onclick="return confirm('Está seguro que desea eliminar la oferta {{$i+1}}: {{$o->nombre_oferta}}?')" href="{{route('eliminar-oferta', $o->id_oferta)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
        @endforeach
        </div>
        <div class="col-md-5">
            <div class="form-group" >
                <label for="nombre_oferta" class="control-label">Nombre de la Oferta:</label>
                <input type="text" class="form-control" name="nombre_oferta" id="nombre_oferta" value="" required />
            </div>
            <div class="form-group" >
                <label for="detalle_oferta" class="control-label">Detalle de la oferta:</label>
                <textarea class="form-control" name="detalle_oferta" id="detalle_oferta" required ></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="producto_" class="control-label">Productos a los que corresponde la oferta</label><br>
                @if(count($productos)>0)
                    @foreach ($productos as $p)
                        <input required type="checkbox" id="producto" onchange="check_producto()" name="productos[]" value="{{$p->id_producto}}">{{$p->nombre}}<br>
                    @endforeach
                @else
                    No tiene productos asignados, por favor registre productos primero! <a class="btn btn-info" href="/productos#modificar_productos">Agregar Productos</a>
                @endif
            </div>
        </div>
        </div>
        <div class="row" style="justify-content: center">
            <button id="boton_ms" type="submit" class="btn btn-primary">
                    <span id="ms_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="ms_enviar">Guardar Oferta</span>
            </button>&nbsp;
            <button id="boton_ms_deshacer" type="reset" class="btn btn-danger">
                Deshacer cambios
            </button>
        </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
function mostrar_oferta(id,nombre,detalle,productos){
    $('#id_oferta').val(id);
    var prods=productos.split(';');
    $('#nombre_oferta').val(nombre);
    $('#detalle_oferta').val(detalle.replace('<br />','\n'));
    $.each(prods,function(i,p){
        $('[value="'+p+'"]').prop('checked',true);
    });
}
function check_producto(){
    $cbx_group = $("[name='productos[]']");
    $cbx_group.prop('required', true);
    if($cbx_group.is(":checked")){
      $cbx_group.prop('required', false);
    }
}
$(document).ready( function () {
    $('#my_form2').on('submit',function(){
        $('#ms_carga').css('display','block');
        $('#ms_enviar').css('display','none');
        $('#boton_ms').prop('disabled', true);
    });
    $("#myModal").modal('show');
    setTimeout(function () {
        $("#myModal").modal('hide');
    }, 2500);
    $('#my_form2').on('reset',function(){
        $('#id_oferta').val('N');
        $('#nombre_oferta').val('');
        $('#detalle_oferta').val('');
        $('[name="productos[]"]').prop('checked',false);
    });
});
</script>
@endsection
