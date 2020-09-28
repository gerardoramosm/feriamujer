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
                        <h2 style="text-align: center">Listado de Productos {{(isset($sel)) ? "del stand ".$st->nombre : "de ".Auth::user()->nombre_empresa}}</h2>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="speaker ftco-animate speaker-1 align-items-center">
                                <div class="text pl-4" style="text-align: center">
                                    <h4 style="text-align: center">
                                        @if(count($productos)==0)
                                            Usted no tiene productos registrados
                                        </h4>
                                        <a class="btn btn-info" href="#modificar_productos">Registrar Productos</a>
                                        @else
                                            Usted tiene {{count($productos)}} productos registrados
                                        </h4>
                                        <a class="btn btn-info" href="#modificar_productos">Modificar Productos</a>
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
                <h2 class="mb-1" id="modificar_productos">Agregar y Modificar Productos</h2>
            </div>
        </div>
        @if(isset($sel))
            <form class="bg-light" id="my_form2" method="POST" action="{{ route('guardar-productos-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
        @else
            <form class="bg-light" id="my_form2" method="POST" action="{{ route('guardar-productos') }}" enctype="multipart/form-data">
        @endif
        <input type="hidden" name="id_producto" id="id_producto" value="N">
        {{ csrf_field() }}
        <div class="row">
        <div class="col-md-3">
        @foreach ($productos as $i=>$p)
            @if($i==0)
            <h4>Productos actuales</h4>
            @endif
            <button type="button" class="btn btn-info" onclick="mostrar_prod('{{$p->id_producto}}','{{$p->nombre}}','{{$p->envasado}}','{{$p->caracteristicas}}','{{$p->fotos}}')">Producto {{$i+1}}: {{$p->nombre}}</button><a onclick="return confirm('Está seguro que desea eliminar el producto {{$i+1}}: {{$p->nombre}}?')" href="{{route('eliminar-producto', $p->id_producto)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
        @endforeach
        </div>
        <div class="col-md-5">
            <div class="form-group" >
                <label for="producto" class="control-label">Nombre del Producto:</label>
                <input type="text" class="form-control" name="producto" id="producto" value="" required />
            </div>
            <div class="form-group" >
                <label for="envasado" class="control-label">Precio del producto:</label>
                <input type="text" class="form-control" name="envasado" id="envasado" required >
            </div>
            <div class="form-group">
                <label for="caracteristicas" class="control-label">Qué características tiene el producto (max. 70 caracteres):</label>
                <textarea class="form-control" name="caracteristicas" maxlength="70" id="caracteristicas"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="foto" class="control-label">Foto(s) del producto</label>
                <input type="file" class="form-control" name="foto[]" id="foto" accept="image/*" multiple />
                <span style="font-size:smaller">Puedes agregar hasta <span id="maxfot">2</span> fotos de tu producto. <strong>El peso máximo por foto es de 1MB</strong></span><br />
                <div id="fotos_existen" style="display:none">
                <input type="hidden" id="fotos" name="fotos" value="">
                    <span>Actualmente tienes <span id="actfot"></span> fotos del producto, las que no estén seleccionadas serán eliminadas:</span><br>
                    <div class="" id="div_foto_1" style="display:none">
                        <input type="checkbox" id="check_foto_1" onchange="ticks()" name="check_foto_1" checked/>
                        <img id="f_foto_1" src="#" style="width:100%" />
                    </div>
                    <div class="" id="div_foto_2" style="display:none">
                        <input type="checkbox" id="check_foto_2" onchange="ticks()" name="check_foto_2" checked/>
                        <img id="f_foto_2" src="#" style="width:100%" />
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row" style="justify-content: center">
            <button id="boton_ms" type="submit" class="btn btn-primary">
                    <span id="ms_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="ms_enviar">Guardar Producto</span>
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
var imagestick=0;
var maximages=2;
function ticks(){
    if($('#check_foto_1').is(':checked') && $('#check_foto_2').is(':checked'))
        imagestick=2;
    else
        if($('#check_foto_1').is(':checked'))
            imagestick=1;
        else
            if($('#check_foto_2').is(':checked'))
                imagestick=1;
            else
                imagestick=0;
}
function mostrar_prod(id,nombre,envasado,caracteristicas,fotos){
    $('#id_producto').val(id);
    $('#producto').val(nombre);
    $('#envasado').val(envasado);
    $('#caracteristicas').val(caracteristicas.replace('<br />','\n'));
    var fot=fotos.split(";");
    $('#fotos').val(fotos);
    $('#maxfot').val(maximages-fot.length);
    $('#actfot').val(fot.length);
    if(fot.length>0)
    {
        $('#f_foto_1').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[0]+"?"+"{{date('Y-m-d H:i:s')}}");
        imagestick=1;
        if(fot.length>1)
        {
            $('#f_foto_2').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[1]+"?"+"{{date('Y-m-d H:i:s')}}");
            $('#check_foto_2').prop('checked',true);
            $('#div_foto_2').show();
            imagestick=2;
        }
        else{
            $('#f_foto_2').attr('src','#');
            $('#check_foto_2').prop('checked',false);
            $('#div_foto_2').hide();
            }
        $('#check_foto_1').prop('checked',true);
        $('#div_foto_1').show();
        $('#fotos_existen').show();
    }
    else
    {
        imagestick=0;
        $('#fotos_existen').hide();
        $('#f_foto_1').attr('src','#');
        $('#check_foto_1').prop('checked',false);
        $('#f_foto_2').attr('src','#');
        $('#check_foto_2').prop('checked',false);
        $('#check_foto_1').prop('checked',false);
        $('#check_foto_2').prop('checked',false);
    }
}
$(document).ready( function () {
    $('#my_form2').on('submit',function(){
        $('#ms_carga').css('display','block');
        $('#ms_enviar').css('display','none');
        $('#boton_ms').prop('disabled', true);
    });
    $('#my_form2').on('reset',function(){
        $('#id_producto').val('N');
        maximages=2;
        imagestick=0;
        $('#fotos').val('');
        $('#fotos_existen').hide();
        $('#f_foto_1').attr('src','#');
        $('#check_foto_1').prop('checked',false);
        $('#f_foto_2').attr('src','#');
        $('#check_foto_2').prop('checked',false);
        $('#check_foto_1').prop('checked',false);
        $('#check_foto_2').prop('checked',false);
    });
    $("#foto").on('change',function(){
        var number_of_images = $(this).get(0).files.length;
        if (number_of_images+imagestick > maximages) {
          alert('Error: No se puede subir más de '+maximages+' fotos.');
          $(this).val('');
          return;
        }
        if(number_of_images>0){
            var sizeFoto_1 = $(this).get(0).files[0].size;
            if (sizeFoto_1 > 2097152) {
              alert('Error: No se puede subir fotos de más de 2 MB.');
              $(this).val('');
            return;
            }    
        }
        if(number_of_images==2)
        {
            var sizeFoto_2 = $(this).get(0).files[1].size;
            if (sizeFoto_2 > 2097152) {
              alert('Error: No se puede subir fotos de más de 1 MB.');
              $(this).val('');
            return;
            }
        }
    });
});
</script>
@endsection
