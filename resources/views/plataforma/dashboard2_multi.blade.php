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
@section('head_scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
  <style>
    .contenedor {
      position: relative;
    }      
    .overlayed {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: rgba(242,116,5,0.5);
      overflow: hidden;
      width: 100%;
      height: 0;
      transition: .5s ease;
    }
    .contenedor:hover .overlayed {
      height: 100%;
    }
    .textu {
      color: white;
      font-size: 24px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
      font-weight: bold;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
@endsection
@section('content')
@if($encuesta==0)
<div class="container">
  <div class="row">
    <div class="{{isset($pago) ? 'col-md-8' : 'col-md-12'}}">
      <div class="panel panel-default ">
        <div class="panel-body p-3 ">
          <h2 style="text-align: center">
            <img src="{{file_exists(dirname(base_path()).'/expositores/public/images/logos/'.$sol->id_user.'_'.$sel.'.jpg') ? url('https://expositores.feicobol.com.bo/images/logos/'.$sol->id_user.'_'.$sel.'.jpg?1') : url('https://expositores.feicobol.com.bo/images/logos/suba_su_logo.png')}}" style="width: 30%">
            Bienvenido a la página principal de {{$sol->nombre}}</h2>
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6">
                  <div class="speaker ftco-animate speaker-1 d-flex align-items-center">
                    <!-- Logo de la empresa -->
                    <div class="text pl-4" style="text-align: center">
                      <h4 style="text-align: center">Datos de la empresa</h2>
                      <p style="text-align: justify">
                      <label><span class="icon-file" style="font-weight: bold">NIT</span></label> {{Auth::user()->nit}}<br>
                      <label><span class="icon-phone" style="font-weight: bold">Teléfono de contacto </span></label> {{$sol->telefono}}<br>
                      <label><span class="icon-map" style="font-weight: bold">Ciudad</span></label> {{$ciud}} - {{$pais}}<br>
                      <label><span class="icon-at" style="font-weight: bold">Correo Electrónico</span></label> {{$sol->email}}<br>
                      <label><span class="icon-globe" style="font-weight: bold">Página Web</span></label> {{$sol->web}}<br>
                      <label><span class="icon-whatsapp" style="font-weight: bold">Número de Whatsapp</span></label> {{$sol->wpp}}<br>
                      <label><span class="icon-instagram" style="font-weight: bold">Página de Instagram</span></label> {{$sol->ig}}<br>
                      <label><span class="icon-facebook" style="font-weight: bold">Página de Facebook</span></label> {{$sol->fb}}<br>
                      <a class="btn btn-info" href="#modificar_empresa">Modificar datos y logo de la empresa</a><br><br>
                      <a class="btn btn-info" href="#modificar_stand">Personalizar el stand</a>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="speaker ftco-animate speaker-1 align-items-center col-md-6">
                  <div class="text pl-4" style="text-align: center">
                    <h4 style="text-align: center">Mapa de puntos de venta</h4>
                    <div style="width: 100%; height: 300px" id="sucursales-map"></div>
                      <a class="btn btn-info" href="#modificar_sucursal">Agregar/Modificar puntos de venta</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
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
              <div class="speaker ftco-animate speaker-1 align-items-center">
                <div class="text pl-4" style="text-align: center">
                  <h4 style="text-align: center">
                  @if(count($ejecutivos)==0)
                    Usted no tiene ejecutivos de ventas registrados
                  </h4>
                  <a class="btn btn-info" href="#modificar_ejecutivos">Registrar Ejecutivos</a>
                  @else
                    Usted tiene {{count($ejecutivos)}} ejecutivos registrados
                  </h4>
                  <a class="btn btn-info" href="#modificar_ejecutivos">Modificar Ejecutivos</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section('body')
<section class="ftco-section">
  @if($encuesta==0)
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
        <h2 class="mb-1" id="modificar_empresa">Modificar datos de la empresa</h2>
      </div>
    </div>
    <form class="" id="my_formDATOS" method="POST" action="{{ route('guardar-empresa-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
      <input type="hidden" name="stand" value="{{$sol->id_stand}}">
        {{ csrf_field() }}
        <div class="row">
          <div class="form-group col-md-4">
            <label for="nombre_empresa">Nombre</label>
            <input type="text" readonly class="form-control-plaintext" value="{{$sol->nombre}}" placeholder="Nombre de la empresa">
          </div>
          <div class="form-group col-md-4">
            <label for="nit">NIT</label>
            <input type="text" readonly class="form-control-plaintext" value="{{Auth::user()->nit}}" placeholder="NIT">
          </div>
          <div class="form-group col-md-4">
            <label for="nombre">Nombre del Stand</label>
            <input type="text" required name="nombre" class="form-control" value="{{$sol->nombre}}" placeholder="Nombre de la empresa">

          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="direccion">Dirección de la Empresa</label>
            <input type="text" id="direccion" required name="direccion" class="form-control" value="{{ null!==(old('direccion')) ? old('direccion') : $sol->direccion}}" placeholder="Dirección de la empresa">
          </div>
          <div class="form-group col-md-4">
            <label for="telefono">Teléfono de contacto de la Empresa</label>
            <input type="text" id="telefono" required name="telefono" class="form-control" value="{{ null!==(old('telefono')) ? old('telefono') : $sol->telefono}}" placeholder="Teléfono de la empresa">
          </div>
          <div class="form-group col-md-4">
            <label for="email">Correo Electrónico de la Empresa</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ null!==(old('email')) ? old('email') : $sol->email}}" placeholder="contacto@tu-empresa.com">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="web">Página web</label>
            <input type="text" id="web" name="web" class="form-control" value="{{ null!==(old('web')) ? old('web') : $sol->web}}" placeholder="www.tuempresa.com">
          </div>
          <div class="form-group col-md-4">
            <label for="pais">País</label>
            <select id="pais" name="pais" required class="form-control" placeholder="Elija el país">
              @foreach ($paises as $p)
              <option value="{{$p->id}}" {{ (null!==old("pais") ? (old("pais") == $p->id ? 'selected' : '') : ($sol->pais==$p->id ? 'selected' : '')) }}>{{$p->nombre}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="ciudad">Ciudad</label>
            <select id="ciudad" name="ciudad" required class="form-control" placeholder="Elija la ciudad">
            @if(null===old('cita'))
              @foreach ($ciudades as $c)
                <option value="{{$c->id}}" {{ (null!==old("ciudad") ? (old("ciudad") == $c->id ? 'selected' : '') : ($sol->ciudad==$c->id ? 'selected' : '')) }}>{{$c->nombre}}</option>
              @endforeach
            @else
              @foreach (old('cita') as $c)
                <option value="{{$c->id}}" {{ (null!==old("ciudad") ? (old("ciudad") == $c->id ? 'selected' : '') : ($sol->ciudad==$c->id ? 'selected' : '')) }}>{{$c->nombre}}</option>
              @endforeach
            @endif
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="descripcion">Descripción de la Empresa (máximo 300 caracteres)</label>
            <textarea id="descripcion" name="descripcion" required class="form-control" maxlength=300 placeholder="Descripción de la empresa">{{ null!==(old('descripcion')) ? old('descripcion') : $sol->descripcion}}</textarea>
          </div>
          <div class="form-group col-md-4">
            <label for="persona_contacto">Persona de contacto</label>
            <input type="text" id="persona_contacto" required name="persona_contacto" class="form-control" value="{{ null!==(old('persona_contacto')) ? old('persona_contacto') : $sol->persona_contacto}}" placeholder="Persona de contacto de la empresa">
          </div>
          <div class="form-group col-md-4">
            <label for="telefono_contacto">Teléfono de contacto del Responsable</label>
            <input type="text" id="telefono_contacto" required name="telefono_contacto" class="form-control" value="{{ null!==(old('telefono_contacto')) ? old('telefono_contacto') : $sol->telefono_contacto}}" placeholder="Teléfono de la empresa">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="email_contacto">Email de la persona de contacto</label>
            <input type="text" id="email_contacto" required name="email_contacto" class="form-control" value="{{ null!==(old('email_contacto')) ? old('email_contacto') : $sol->email_contacto}}" placeholder="Persona de contacto de la empresa">
          </div>
          <div class="form-group col-md-4">
            <label for="wpp">Número de Whatsapp</label>
            <input type="text" id="wpp" name="wpp" class="form-control" value="{{ null!==(old('wpp')) ? old('wpp') : $sol->wpp}}" placeholder="Número con Whatsapp para pedidos">
          </div>
          <div class="form-group col-md-4">
            <label for="fb">Página de Facebook</label>
            <input type="text" id="fb" name="fb" class="form-control" value="{{ null!==(old('fb')) ? old('fb') : $sol->fb}}" placeholder="www.facebook.com/tu-página">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="ig">Página de Instagram</label>
            <input type="text" id="ig" name="ig" class="form-control" value="{{ null!==(old('ig')) ? old('ig') : $sol->ig}}" placeholder="www.instagram.com/tu-página">
          </div>
          <div class="form-group col-md-4">
            <label for="tw">Página de Twitter</label>
            <input type="text" id="tw" name="tw" class="form-control" value="{{ null!==(old('tw')) ? old('tw') : $sol->tw}}" placeholder="www.twitter.com/tu-página">
          </div>
          <div class="form-group col-md-4">
            <label for="yt">Página de YouTube</label>
            <input type="text" id="yt" name="yt" class="form-control" value="{{ null!==(old('yt')) ? old('yt') : $sol->yt}}" placeholder="www.youtube.com/tu-página">
          </div>
      </div>
      <div class="row">
        @if($sol->tipo>500)
        <div class="form-group col-md-4">
          <label for="videochat">Habilitar videochat?</label><br>
          <div class="custom-control custom-switch">
            <input type="checkbox" id="videochat" onchange="videoch()" name="videochat" class="custom-control-input" @if($sol->videochat==1) checked @endif>  <label class="custom-control-label" for="videochat">Habilitar VideoChat</label>
          </div>
          <div id="videochat_horario" @if($sol->videochat==1) style="display: block" @else style="display:none" @endif>
          <div class="input-group date" id="datetimepicker3_1" data-target-input="nearest">
            Desde
            <input type="text" name="video_inicio" class="form-control datetimepicker-input" data-target="#datetimepicker3_1"/>
            <div class="input-group-append" data-target="#datetimepicker3_1" data-toggle="datetimepicker">
              <div class="input-group-text"><ion-icon name="time-outline"></ion-icon></div>
            </div>
          </div>
          <div class="input-group date" id="datetimepicker3_2" data-target-input="nearest">
            Hasta
            <input type="text" name="video_fin" class="form-control datetimepicker-input" data-target="#datetimepicker3_2"/>
            <div class="input-group-append" data-target="#datetimepicker3_2" data-toggle="datetimepicker">
              <div class="input-group-text"><ion-icon name="time-outline"></ion-icon></div>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="form-group col-md-4">
          <label for="video">Video de Presentación</label>
          <input type="text" id="video" name="video" class="form-control" value="{{ null!==(old('video')) ? old('video') : $sol->video}}" placeholder="Link al video de YouTube, Vimeo o Facebook">
        </div>
        @if($sol->tipo>350)
        <div class="form-group col-md-4">
          <label for="video2">Video de Presentación 2</label>
          <input type="text" id="video2" name="video2" class="form-control" value="{{ null!==(old('video2')) ? old('video2') : $sol->video2}}" placeholder="Link al video de YouTube, Vimeo o Facebook">
        </div>
        @endif
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label for="logo">Logo</label>
          <input id="logo" type="file" class="form-control" accept="image/*" name="logo">
          <strong>El peso máximo del logo es de 2MB</strong>
        </div>
      </div>
      <div class="row" style="justify-content: center">
        <button id="boton_md" type="submit" class="btn btn-primary">
          <span id="md_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="md_enviar">Guardar Modificaciones</span>
        </button>
      </div>
    </form>
  </div>
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
        <h2 class="mb-1" id="modificar_sucursal">Agregar y Modificar Sucursales</h2>
      </div>
    </div>
    <form class="" id="my_formSUCS" method="POST" action="{{ route('guardar-sucursales-stand',['stand'=>$sol->id_stand]) }}">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-3">
          @foreach ($sucs as $i=>$s)
            @if($i==0)
            <h4>Sucursales actuales</h4>
            @endif
            Sucursal {{$i+1}}: {{$s->address}} <button type="button" class="btn btn-success" onclick="mostrar_sucursal('{{$s->id_sucursal}}','{{$s->lat}}','{{$s->lon}}','{{$s->address}}','{{$s->caracteristicas}}','{{$s->telefono}}')"><ion-icon name="pencil-sharp"></ion-icon></button><a onclick="return confirm('Está seguro que desea eliminar la sucursal {{$i+1}}: {{$s->address}}?')" href="{{route('eliminar-sucursal', $s->id_sucursal)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
          @endforeach
        </div>
        <div class="col-md-5">
          <div class="form-group" >
            <label for="direccion_sucursal" class="control-label">Ubicación:</label>
            <input type="text" class="form-control" required name="direccion_sucursal" id="direccion_sucursal" />
          </div>
          <div class="form-group">
            <label for="telefono_sucursal" class="control-label">Teléfono de contacto de esta sucursal:</label>
            <input type="text" class="form-control" name="telefono_sucursal" id="telefono_sucursal" required >
          </div>
          <div class="form-group">
            <label for="caracteristicas_sucursal" class="control-label">Características de este lugar:</label>
            <textarea class="form-control" name="caracteristicas_sucursal" id="caracteristicas_sucursal" ></textarea>
            <span style="font-size:smaller">Puedes colocar si este lugar vende al por mayor, solo al detalle, o alguna característica de ubicación (puerta color rojo, al frente del parque, etc)</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group" style="height:350px;">
          <input type="hidden" name="identificador" id="identificador" value="N" />
          <input type="hidden" name="lat" id="lat" value="{{$sol->lat}}" />
          <input type="hidden" name="lon" id="lon" value="{{$sol->lon}}" />
          <label for="address-map" class="control-label">Ubicación en el Mapa:</label>
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
<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
      <h2 class="mb-1" id="modificar_productos">Agregar y Modificar Productos</h2>
    </div>
  </div>
  @if(isset($sel))
    <form class="" id="my_formPRODS" method="POST" action="{{ route('guardar-productos-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
  @else
    <form class="" id="my_formPRODS" method="POST" action="{{ route('guardar-productos') }}" enctype="multipart/form-data">
  @endif
  <input type="hidden" name="id_producto" id="id_producto" value="N">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-3">
      @foreach ($productos as $i=>$p)
        @if($i==0)
        <h4>Productos actuales</h4>
        @endif
        <button type="button" class="btn btn-info" onclick="mostrar_prod('{{$p->id_producto}}','{{$p->nombre}}','{{$p->envasado}}','{{$p->caracteristicas}}','{{$p->adj}}','{{$p->fotos}}')">Producto {{$i+1}}: {{$p->nombre}}</button><a onclick="return confirm('Está seguro que desea eliminar el producto {{$i+1}}: {{$p->nombre}}?')" href="{{route('eliminar-producto', $p->id_producto)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
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
          <label for="caracteristicas_producto" class="control-label">Qué características tiene el producto (max. 300 caracteres):</label>
          <textarea class="form-control" name="caracteristicas_producto" maxlength="300" id="caracteristicas_producto"></textarea>
        </div>
        @if($sol->tipo>350)
        <div class="form-group">
          <label for="adj_producto" class="control-label">Documentos Adjuntos:</label>
          <input type="file" multiple id="adj_producto" name="adj_producto[]" class="form-control">
          <span style="font-size: smaller">Puedes subir hasta 10 adjuntos por producto (brochures, hojas de información, etc.)</span>
          <div id="adj_existen" style="display: none">
          <input type="hidden" id="adjs" name="adjs" value="">
            <span>Actualmente tienes <span id="actadj"></span> documentos del producto, los que no estén seleccionadas serán eliminadas:</span><br>
            @for($i=0;$i<10;$i++)
            <div class="" id="div_prod_{{$i}}" style="display:none">
              <input type="checkbox" id="check_prod_{{$i}}" onchange="ticks_adj()" name="check_prod[{{$i}}]" />
              <span style="title-text" id="tit_prod_{{$i}}"></span>
              <a href="#" id="url_prod_{{$i}}" class="btn btn-primary">Descargar</a>
            </div>
            @endfor
          </div>            
        </div>
        @endif
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="foto" class="control-label">Foto(s) del producto</label>
          <input type="file" class="form-control" name="foto[]" id="foto" accept="image/*" multiple />
          <span style="font-size:smaller">Puedes agregar hasta <span id="maxfot">4</span> fotos de cada producto. <strong>El peso máximo por foto es de 2MB</strong></span><br />
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
            @if($sol->tipo>350)
            <div class="" id="div_foto_3" style="display:none">
              <input type="checkbox" id="check_foto_3" onchange="ticks()" name="check_foto_3" checked/>
              <img id="f_foto_3" src="#" style="width:100%" />
            </div>
            @endif
            @if($sol->tipo>500)
            <div class="" id="div_foto_4" style="display:none">
              <input type="checkbox" id="check_foto_4" onchange="ticks()" name="check_foto_4" checked/>
              <img id="f_foto_4" src="#" style="width:100%" />
            </div>
            <div class="" id="div_foto_5" style="display:none">
              <input type="checkbox" id="check_foto_5" onchange="ticks()" name="check_foto_5" checked/>
              <img id="f_foto_5" src="#" style="width:100%" />
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="justify-content: center">
      <button id="boton_mp" type="submit" class="btn btn-primary">
        <span id="mp_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="mp_enviar">Guardar Producto</span>
      </button>&nbsp;
      <button id="boton_mp_deshacer" type="reset" class="btn btn-danger">
        Deshacer cambios
      </button>
    </div>
  </form>
</div>
<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
      <h2 class="mb-1" id="modificar_ofertas">Agregar y Modificar Ofertas</h2>
    </div>
  </div>
  @if(isset($sel))
    <form class="" id="my_formOFF" method="POST" action="{{ route('guardar-ofertas-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
  @else
    <form class="" id="my_formOFF" method="POST" action="{{ route('guardar-ofertas') }}" enctype="multipart/form-data">
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
          No tiene productos asignados, por favor registre productos primero! <a class="btn btn-info" href="#modificar_productos">Agregar Productos</a>
        @endif
      </div>
    </div>
  </div>
  <div class="row" style="justify-content: center">
    <button id="boton_mo" type="submit" class="btn btn-primary" @if(count($productos)==0) disabled @endif >
    <span id="mo_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Enviando</span><span id="mo_enviar">Guardar Oferta</span>
    </button>&nbsp;
    <button id="boton_mo_deshacer" type="reset" class="btn btn-danger">
      Deshacer cambios
    </button>
  </div>
  </form>
</div>
<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
      <h2 class="mb-1" id="modificar_ejecutivos">Agregar y Modificar Ejecutivos</h2>
    </div>
  </div>
  @if(isset($sel))
    <form class="" id="my_formEJE" method="POST" action="{{ route('guardar-ejecutivos-stand',['stand'=>$sel]) }}" enctype="multipart/form-data">
  @else
    <form class="" id="my_formEJE" method="POST" action="{{ route('guardar-ejecutivos') }}" enctype="multipart/form-data">
  @endif
  <input type="hidden" name="id_ejecutivo" id="id_ejecutivo" value="N">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-4">
    @foreach ($ejecutivos as $i=>$e)
      @if($i==0)
      <h4>Ejecutivos registrados</h4>
      @endif
      <button type="button" class="btn btn-info" onclick="mostrar_ejecutivo('{{$e->id_ejecutivo}}','{{$e->nombre}}','{{$e->cargo}}','{{$e->modo_contacto}}','{{$e->link}}',@if(file_exists(dirname(base_path()).'/mascotas/public/img/ejecutivos/'.$e->id_ejecutivo.'.jpg')) true @else false @endif)">{{$e->nombre}}</button><a onclick="return confirm('Está seguro que desea eliminar a {{$e->nombre}}?')" href="{{route('eliminar-ejecutivos', $e->id_ejecutivo)}}" class="btn btn-danger"><ion-icon name="trash-sharp"></ion-icon></a><br>
    @endforeach
  </div>
  <div class="col-md-8">
    <div class="form-group" >
      <label for="nombre_ejecutivo" class="control-label">Nombre:</label>
      <input type="text" class="form-control" name="nombre_ejecutivo" id="nombre_ejecutivo" value="" required />
    </div>
    <div class="form-group" >
      <label for="cargo_ejecutivo" class="control-label">Cargo:</label>
      <textarea class="form-control" name="cargo_ejecutivo" id="cargo_ejecutivo" required ></textarea>
    </div>
    <div class="form-group" >
      <label for="modo_contacto_ejecutivo" class="control-label">Modo de Contacto:</label>
      <select id="modo_contacto_ejecutivo" name="modo_contacto_ejecutivo" class="form-control">
        <option value="1" selected>Whatsapp</option>
        <option value="2">Zoom</option>
      </select>
    </div>
    <div class="form-group" >
      <label for="link_ejecutivo" class="control-label">Link/Número de contacto:</label>
      <textarea class="form-control" name="link_ejecutivo" id="link_ejecutivo" required ></textarea>
    </div>
    <div class="form-group" >
      <label for="foto_ejecutivo" class="control-label">Foto:</label>
      <input type="file" class="form-control" name="foto_ejecutivo" id="foto_ejecutivo" accept="image/*" />
      <img id="foto_ejecutivo_ant" src="#" style="height: 50px;display:none">
    </div>
  </div>
</div>
<div class="row" style="justify-content: center">
  <button id="boton_es" type="submit" class="btn btn-primary" >
    <span id="es_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Guardando</span><span id="es_enviar">Guardar Ejecutivo</span>
  </button>&nbsp;
  <button id="boton_es_deshacer" type="reset" class="btn btn-danger">
    Deshacer cambios
  </button>
</div>
</form>
</div>
<div class="container">
  <div class="row justify-content-center mb-5">
    <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
      <h2 class="mb-1" id="modificar_stand">Modificar el stand</h2>
    </div>
  </div>
  @if(isset($sel))
    <form class="" id="my_formSTAND" method="POST" action="{{ route('guardar-stands',['stand'=>$sel]) }}" enctype="multipart/form-data">
  @else
    <form class="" id="my_formSTAND" method="POST" action="{{ route('guardar-stand') }}" enctype="multipart/form-data">
  @endif
  {{ csrf_field() }}
  <div class="row">
    <div class="col-5">
      <span>Aquí puede visualizar los espacios disponibles para poner imágenes de su empresa, con los tamaños correspondientes</span> 
      <img src="{{asset('img/standFGuia-'.$sol->tipo.'.jpg')}}" style="width: 100%">
      @php $medidas=array("350"=>array("112x49","212x93","252x413"),"500"=>array("119x66","371x116","188x266"),"700"=>array("130x61","166x92","199x299")); @endphp
    </div>
    <div class="col-7">
      <div class="row">
        <div class="form-group col-md-6" >
          <label for="imagen_1" class="control-label">Espacio "A" (medidas: {{$medidas[$sol->tipo][0]}} o superior, peso no mayor a 2MB):</label>
          <input type="file" class="form-control" name="imagen_1" accept="image/*" id="imagen_1" />
          @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$sol->id_user.'_'.$sel.'_1.jpg'))
            <img src="https://virtual.feicobol.com.bo/img/stand_images/{{$sol->id_user}}_{{$sel}}_1.jpg?{{date('Y-m-d H:i:s')}}" style="height:50px">
            <input type="checkbox" name="check_imagen_1" id="check_imagen_1" onclick="tick1()" checked>Mantener la imagen<br>
            <span id="aviso_imagen_1" style="color: red"></span>
          @endif
        </div>
        <div class="form-group col-md-6" >
          <label for="imagen_2" class="control-label">Espacio "B" (medidas: {{$medidas[$sol->tipo][1]}} o superior, peso no mayor a 2MB):</label>
          <input type="file" class="form-control" name="imagen_2" id="imagen_2" accept="image/*" />
          @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$sol->id_user.'_'.$sel.'_2.jpg'))
            <img src="https://virtual.feicobol.com.bo/img/stand_images/{{$sol->id_user}}_{{$sel}}_2.jpg?{{date('Y-m-d H:i:s')}}" style="height:50px">
            <input type="checkbox" name="check_imagen_2" id="check_imagen_2" onclick="tick2()" checked>Mantener la imagen<br>
            <span id="aviso_imagen_2" style="color: red"></span>
          @endif
        </div>
        <div class="form-group col-md-6" >
          <label for="imagen_3" class="control-label">Espacio "C"  (medidas: {{$medidas[$sol->tipo][2]}} o superior, peso no mayor a 2MB):</label>
          <input type="file" class="form-control" name="imagen_3" id="imagen_3" accept="image/*" />
          @if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.$sol->id_user.'_'.$sel.'_3.jpg'))
            <img src="https://virtual.feicobol.com.bo/img/stand_images/{{$sol->id_user}}_{{$sel}}_3.jpg" style="height:50px">
            <input type="checkbox" name="check_imagen_3" id="check_imagen_3" onclick="tick3()" checked>Mantener la imagen<br>
            <span id="aviso_imagen_3" style="color: red"></span>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="justify-content: center">
    <button id="boton_st" type="submit" class="btn btn-primary" >
      <span id="st_carga" style="display:none"><i class="fa fa-spinner fa-spin"></i>Guardando</span><span id="st_enviar">Guardar</span>
    </button>&nbsp;
    <button id="boton_st_deshacer" type="reset" class="btn btn-danger">
      Deshacer cambios
    </button>
  </div>
  </form>
</div>
@else
  @if($encuesta==1)
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
      <br>
      <h2 class="mb-1" id="encuesta">Participa en la encuesta de Satisfacción de MiPyME Digital</h2>
      </div>
    </div>
    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdorDCCM82CyMT8Xe8paXN03sSan-2nUBYU_9iI9PucQSpycA/viewform?embedded=true" width="100%" height="3711" 
    frameborder="0" marginheight="0" marginwidth="0">
    Cargando…</iframe>
  </div>
  @else
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center heading-section ftco-animate fadeInUp ftco-animated">
        <br>
          <h2 class="mb-1" id="encuesta">  Muchas gracias por la información enviada, puede descargar los resultados de su stand aquí<br>
            <a href="informe/{{Auth::user()->id_empresa}}_{{$sol->id_stand}}" class="btn btn-primary">Descargar informe del stand</a>
          </h2>
      </div>
    </div>
  </div>
  @endif
@endif
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<script src="{{asset('/js/mapa.js?2')}}"></script>
<script>
  var tilelay=L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://cloudmade.com">CloudMade</a>',
    maxZoom: 18
    });
  var sucursalesmap = L.map('sucursales-map',{
    zoomControl: true,
    layers:tilelay,
    maxZoom: 18,
    minZoom: 6
  }).setView([parseFloat({{$sol->lat}}),parseFloat({{$sol->lon}})], 13);
  var mark = L.marker([{{$sol->lat}},{{$sol->lon}}]).addTo(sucursalesmap);
  @foreach($sucs as $s)
    var mark = L.marker([{{$s->lat}},{{$s->lon}}]).addTo(sucursalesmap);
  @endforeach
  function videoch(){
    if($('#videochat').is(':checked')){
      $('#videochat_horario').css('display','block');
    }
    else
    {
      $('#videochat_horario').css('display','none');
    }
  }
  function mostrar_sucursal(id,lat,lon,add,caract,fono){
    $('#identificador').val(id);
    $('#lat').val(lat);
    $('#lon').val(lon);
    $('#direccion_sucursal').val(add);
    $('#caracteristicas_sucursal').val(caract.split('<br />').join('\n'));
    $('#telefono_sucursal').val(fono.split('<br />').join('\n'));
    mymap.setView([lat,lon],15);
    marker.setLatLng(new L.LatLng(lat,lon),{draggable:'true'}).bindPopup(new L.LatLng(lat,lon)).update();
    setTimeout(function () { mymap.invalidateSize();}, 500);
    if(id==0)
    {
      $('#telf_visible').css('display','none');
      $('#caract_visible').css('display','none');
      $('#caracteristicas_sucursal').val(1);
      $('#telefono_sucursal').val(1);
    }
    else{
      $('#telf_visible').css('display','block');
      $('#caract_visible').css('display','block');
      $('#caracteristicas_sucursal').val(caract.split('<br />').join('\n'));
      $('#telefono_sucursal').val(fono.split('<br />').join('\n'));  
    }
  }
function mostrar_ejecutivo(id,nombre,cargo,modo,link,foto){
  $('#id_ejecutivo').val(id);
  $('#nombre_ejecutivo').val(nombre);
  $('#cargo_ejecutivo').val(cargo.split('<br />').join('\n'));
  $('#modo_contacto_ejecutivo option[value="1"]').prop('selected', false);
  $('#modo_contacto_ejecutivo option[value="'+modo+'"]').prop('selected', true);
  $('#link_ejecutivo').val(link);
  if(foto){
    $('#foto_ejecutivo_ant').attr('src','https://mascotas.feicobol.com/img/ejecutivos/'+id+'.jpg');
    $('#foto_ejecutivo_ant').css('display','block');
  }
}
function mostrar_oferta(id,nombre,detalle,productos){
  $('#id_oferta').val(id);
  var prods=productos.split(';');
  $('#nombre_oferta').val(nombre);
  $('#detalle_oferta').val(detalle.split('<br />').join('\n'));
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
function tick1(){
  if($('#check_imagen_1').is(':checked'))
    $('#aviso_imagen_1').text('La imagen se mantendrá');
  else
    $('#aviso_imagen_1').text('La imagen se eliminará');
}
function tick2(){
  if($('#check_imagen_2').is(':checked'))
    $('#aviso_imagen_2').text('La imagen se mantendrá');
  else
    $('#aviso_imagen_2').text('La imagen se eliminará');
}
function tick3(){
  if($('#check_imagen_3').is(':checked'))
    $('#aviso_imagen_3').text('La imagen se mantendrá');
  else
    $('#aviso_imagen_3').text('La imagen se eliminará');
}
$(document).ready( function () {
  @if($sol->tipo>500)
  $('#datetimepicker3_1').datetimepicker({
    format: 'LT',
    @if($sol->videochat==1)
      date: moment('{{$sol->video_inicio}}', 'HH:mm')
    @else
      date: moment('8:30', 'HH:mm')
    @endif
  });
  $('#datetimepicker3_2').datetimepicker({
    format: 'LT',
    @if($sol->videochat==1)
      date: moment('{{$sol->video_fin}}', 'HH:mm')
    @else
      date: moment('20:30', 'HH:mm')
      @endif
  });
  @endif
  $('#my_formSUCS').on('submit',function(){
      $('#ms_carga').css('display','block');
      $('#ms_enviar').css('display','none');
      $('#boton_ms').prop('disabled', true);
  });
  $("#myModal").modal('show');
  setTimeout(function () {
      $("#myModal").modal('hide');
  }, 2500);
  $('#my_formOFF').on('reset',function(){
      $('#id_oferta').val('N');
      $('#nombre_oferta').val('');
      $('#detalle_oferta').val('');
      $('[name="productos[]"]').prop('checked',false);
  });
  @if(session('status'))
    $('#myModal').modal('show');
    setTimeout(function () {
      $("#myModal").modal('hide');
    }, 2000);
  @endif
    $('#my_formSUCS').on('reset',function(){
      $('#identificador').val('N');
      $('#lat').val(-17.3930281);
      $('#lon').val(-66.1523097);
      $('#telf_visible').css('display','block');
      $('#caract_visible').css('display','block');
      mymap.setView([-17.3930281,-66.1523097],15);
      marker.setLatLng(new L.LatLng(-17.3930281,-66.1523097),{draggable:'true'}).bindPopup(new L.LatLng(-17.3930281,-66.1523097)).update();
      setTimeout(function () { mymap.invalidateSize();}, 500);
    });
    $('#my_formDATOS').on('submit',function(){
        $('#md_carga').css('display','block');
        $('#md_enviar').css('display','none');
        $('#boton_md').prop('disabled', true);
    });
    $('#my_formOFF').on('submit',function(){
        $('#mo_carga').css('display','block');
        $('#mo_enviar').css('display','none');
        $('#boton_mo').prop('disabled', true);
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
//      alert(data);
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
  $("#imagen_5").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir imágenes de más de 2 MB.');
      $(this).val('');
    }    
    else
    {
      $('#check_imagen_5').prop('checked',false);
      tick5();
    }
  });
  $("#imagen_4").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir imágenes de más de 2 MB.');
      $(this).val('');
    }    
    else
    {
      $('#check_imagen_4').prop('checked',false);
      tick4();
    }
  });
  $("#imagen_3").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir imágenes de más de 2 MB.');
      $(this).val('');
    }
    else
    {
      $('#check_imagen_3').prop('checked',false);
      tick3();
    }
  });
  $("#imagen_2").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir imágenes de más de 2 MB.');
      $(this).val('');
    }    
    else
    {
      $('#check_imagen_2').prop('checked',false);
      tick2();
    }
  });
  $("#imagen_1").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir imágenes de más de 2 MB.');
      $(this).val('');
    }    
    else
    {
      $('#check_imagen_1').prop('checked',false);
      tick1();
    }
  });
  $("#logo").on('change',function(){
    var sizeFoto = $(this).get(0).files[0].size;
    if (sizeFoto > 2097152) {
      alert('Error: No se puede subir logos de más de 2 MB.');
      $(this).val('');
    }    
  });
  $('#my_formSTAND').on('submit',function(){
    $('#st_carga').css('display','block');
    $('#st_enviar').css('display','none');
    $('#boton_st').prop('disabled', true);
  });
  $('#my_formSTAND').on('reset',function(){
    $('#imagen_1').val('');
    $('#imagen_2').val('');
    $('#imagen_3').val('');
  });
    $('#my_formEJE').on('submit',function(){
      $('#es_carga').css('display','block');
      $('#es_enviar').css('display','none');
      $('#boton_es').prop('disabled', true);
  });
  $('#my_formEJE').on('reset',function(){
    $('#id_ejecutivo').val('N');
    $('#nombre_ejecutivo').val('');
    $('#cargo_ejecutivo').val('');
    $('#link_ejecutivo').val('');
    $('#foto_ejecutivo').val('');
    $('#foto_ejecutivo_ant').css('display','none');
  });
  $('#my_formPRODS').on('submit',function(){
      $('#mp_carga').css('display','block');
      $('#mp_enviar').css('display','none');
      $('#boton_mp').prop('disabled', true);
  });
  $('#my_formPRODS').on('reset',function(){
      $('#id_producto').val('N');
      @if($sol->tipo==350)
        maximages=2;
      @elseif($sol->tipo==500)
        maximages=3;
      @else
        maximages=5;
      @endif
      imagestick=0;
      $('#fotos').val('');
      $('#fotos_existen').hide();
      $('#f_foto_1').attr('src','#');
      $('#check_foto_1').prop('checked',false);
      $('#f_foto_2').attr('src','#');
      $('#check_foto_2').prop('checked',false);
      @if($sol->tipo>350)
        $('#f_foto_3').attr('src','#');
        $('#check_foto_3').prop('checked',false);
      @endif
      @if($sol->tipo>500)
        $('#f_foto_4').attr('src','#');
        $('#check_foto_4').prop('checked',false);
        $('#f_foto_5').attr('src','#');
        $('#check_foto_5').prop('checked',false);
      @endif
  });
  @if($sol->tipo>=500)
  $("#adj_producto").on('change',function(){
    if (parseInt($('#adj_producto').get(0).files.length) > 10-adjstick){
      alert("ERROR: Puede subir máximo "+(10-adjstick)+" archivos de hasta 2 MB cada uno");
      $("#adj_producto").val('');
   }
   else{
    $('#adj_producto').each(function(index,field){
      for (ij=0;ij<field.files.length;ij++)
        if(field.files[ij].size>2097152){
          alert("ERROR: No se puede subir archivos de más de 2 MB");
          $("#adj_producto").val('');
          break;
        }
    });
   }
  });
  @endif
  $("#foto").on('change',function(){
      var number_of_images = $(this).get(0).files.length;
      if (number_of_images+imagestick > maximages) {
        alert('Error: No se puede subir más de '+maximages+' fotos.');
        $(this).val('');
        return;
      }
      if(number_of_images>=1){
        var sizeFoto_1 = $(this).get(0).files[0].size;
        if (sizeFoto_1 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
        return;
        }    
      }
      if(number_of_images>=2)
      {
        var sizeFoto_2 = $(this).get(0).files[1].size;
        if (sizeFoto_2 > 2097152) {
          alert('Error: No se puede subir fotos de más de 1 MB.');
          $(this).val('');
        return;
        }
      }
      @if($sol->tipo>350)
      if(number_of_images>=3)
      {
        var sizeFoto_3 = $(this).get(0).files[2].size;
        if (sizeFoto_3 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
        return;
        }
      }
      @endif
      @if($sol->tipo>500)
      if(number_of_images==4)
      {
        var sizeFoto_4 = $(this).get(0).files[3].size;
        if (sizeFoto_4 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
        return;
        }
      }
      if(number_of_images==5)
      {
        var sizeFoto_5 = $(this).get(0).files[4].size;
        if (sizeFoto_5 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
        return;
        }
      }
      @endif
    });
});
  var imagestick=0;
  @if($sol->tipo==350)
  var maximages=2;  
  @elseif($sol->tipo==500)
    var maximages=3;  
  @else
    var maximages=5;  
  @endif
  function ticks(){
    imagestick=0;
    if($('#check_foto_1').is(':checked'))
      imagestick++;
    if($('#check_foto_2').is(':checked'))
      imagestick++;
    if($('#check_foto_3').is(':checked'))
      imagestick++;
    /*if($('#check_foto_4').is(':checked'))
      imagestick++;*/
  }
  var adjtotal=0;
  var adjstick=0;
  function ticks_adj(){
    for(i=0;i<adjtotal;i++){
      if($('#check_prod_'+i).is(':checked'))
        adjstick=adjstick;
      else
        adjstick--;
    }
  }
  function mostrar_prod(id,nombre,envasado,caracteristicas,adj,fotos){
      $('#id_producto').val(id);
      $('#producto').val(nombre);
      $('#envasado').val(envasado);
      $('#caracteristicas_producto').val(caracteristicas.split('<br />').join('\n'));
      if(adj!=''){
        $('#adjs').val(adj);
        var adjs=adj.split(";");
        adjstick=adjs.length;
        adjtotal=adjs.length;
        for(ij=0;ij<adjs.length;ij++)
        {
          $('#url_prod_'+ij).attr('href','https://mascotas.feicobol.com/pdf/'+adjs[ij]);
          $('#check_prod_'+ij).prop('checked',true);
          $('#tit_prod_'+ij).text(adjs[ij]);
          $('#div_prod_'+ij).show();
        }
        for(ij=adjs.length;ij<10;ij++)
          $('#div_prod_'+ij).hide();
        $('#actadj').text(adjs.length);
        $('#adj_existen').show();
      }
      var fot=fotos.split(";");
      $('#fotos').val(fotos);
      if(fotos!='')
      {
        $('#maxfot').val(maximages-fot.length);
        $('#actfot').val(fot.length);  
      }
      else
      {
        $('#maxfot').val(maximages);
        $('#actfot').val(0);
      }
      $('#f_foto_1').attr('src','#');
      $('#check_foto_1').prop('checked',false);
      $('#div_foto_1').hide();
      $('#f_foto_2').attr('src','#');
      $('#check_foto_2').prop('checked',false);
      $('#div_foto_2').hide();
      @if($sol->tipo>350)
      $('#f_foto_3').attr('src','#');
      $('#check_foto_3').prop('checked',false);
      $('#div_foto_3').hide();
      @endif
      @if($sol->tipo>500)
      $('#f_foto_4').attr('src','#');
      $('#check_foto_4').prop('checked',false);
      $('#div_foto_4').hide();
      $('#f_foto_5').attr('src','#');
      $('#check_foto_5').prop('checked',false);
      $('#div_foto_5').hide();
      @endif    
      if(fot.length>0 && fot[0]!='')
      {
        if(fot.length>=1)
        {
          $('#f_foto_1').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[0]+"?"+"{{date('Y-m-d H:i:s')}}");
          imagestick=1;
          $('#check_foto_1').prop('checked',true);
          $('#div_foto_1').show();
          $('#fotos_existen').show();
        }
        if(fot.length>=2)
        {
          $('#f_foto_2').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[1]+"?"+"{{date('Y-m-d H:i:s')}}");
          imagestick=2;
          $('#check_foto_2').prop('checked',true);
          $('#div_foto_2').show();
          $('#fotos_existen').show();
        }
        @if($sol->tipo>350)
        if(fot.length>=3)
        {
          $('#f_foto_3').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[2]+"?"+"{{date('Y-m-d H:i:s')}}");
          imagestick=3;
          $('#check_foto_3').prop('checked',true);
          $('#div_foto_3').show();
          $('#fotos_existen').show();
        }
      @endif
      @if($sol->tipo>500)
      if(fot.length>=4)
      {
        $('#f_foto_4').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[3]+"?"+"{{date('Y-m-d H:i:s')}}");
        imagestick=4;
        $('#check_foto_4').prop('checked',true);
        $('#div_foto_4').show();
        $('#fotos_existen').show();
      }
      if(fot.length==5)
      {
        $('#f_foto_5').attr('src','https://virtual.feicobol.com.bo/img/productos/'+fot[4]+"?"+"{{date('Y-m-d H:i:s')}}");
        imagestick=5;
        $('#check_foto_5').prop('checked',true);
        $('#div_foto_5').show();
        $('#fotos_existen').show();
      }
      @endif
      }
      else
      {
          imagestick=0;
          $('#fotos_existen').hide();
          $('#f_foto_1').attr('src','#');
          $('#check_foto_1').prop('checked',false);
          $('#f_foto_2').attr('src','#');
          $('#check_foto_2').prop('checked',false);
          @if($sol->tipo>350)
          $('#f_foto_3').attr('src','#');
          $('#check_foto_3').prop('checked',false);
          @endif
          @if($sol->tipo>500)
          $('#f_foto_4').attr('src','#');
          $('#check_foto_4').prop('checked',false);
          $('#f_foto_5').attr('src','#');
          $('#check_foto_5').prop('checked',false);
          @endif
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
      @if($sol->tipo==350)
        var maximages=2;  
      @elseif($sol->tipo==500)
        var maximages=3;  
      @else
        var maximages=5;  
      @endif
      imagestick=0;
      $('#fotos').val('');
      $('#fotos_existen').hide();
      $('#f_foto_1').attr('src','#');
      $('#check_foto_1').prop('checked',false);
      $('#f_foto_2').attr('src','#');
      $('#check_foto_2').prop('checked',false);
      @if($sol->tipo>350)
      $('#f_foto_3').attr('src','#');
      $('#check_foto_3').prop('checked',false);
      @endif
      @if($sol->tipo>500)
      $('#f_foto_4').attr('src','#');
      $('#check_foto_4').prop('checked',false);
      $('#f_foto_5').attr('src','#');
      $('#check_foto_5').prop('checked',false);
      @endif
      });
      @if($sol->tipo>500)
      $("#adj_producto").on('change',function(){
        if (parseInt($('#adj_producto').get(0).files.length) > 10-adjstick){
          alert("ERROR: Puede subir máximo "+(10-adjstick)+" archivos de hasta 2 MB cada uno");
          $("#adj_producto").val('');
       }
       else{
        $('#adj_producto').each(function(index,field){
          for (ij=0;ij<field.files.length;ij++)
          if(field.files[ij].size>2097152){
            alert("ERROR: No se puede subir archivos de más de 2 MB");
            $("#adj_producto").val('');
            break;
          }
        });
       }
      });
      @endif
      $("#foto").on('change',function(){
        var number_of_images = $(this).get(0).files.length;
        if (number_of_images+imagestick > maximages) {
          alert('Error: No se puede subir más de '+maximages+' fotos.');
          $(this).val('');
          return;
        }
        if(number_of_images>=1){
          var sizeFoto_1 = $(this).get(0).files[0].size;
          if (sizeFoto_1 > 2097152) {
            alert('Error: No se puede subir fotos de más de 2 MB.');
            $(this).val('');
          return;
          }    
      }
      if(number_of_images>=2)
      {
          var sizeFoto_2 = $(this).get(0).files[1].size;
          if (sizeFoto_2 > 2097152) {
            alert('Error: No se puede subir fotos de más de 2 MB.');
            $(this).val('');
          return;
          }
      }
      @if($sol->tipo>350)
      if(number_of_images>=3)
      {
        var sizeFoto_3 = $(this).get(0).files[2].size;
        if (sizeFoto_3 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
        return;
        }
      }
      @endif
      @if($sol->tipo>500)
      if(number_of_images==4){
        var sizeFoto_4 = $(this).get(0).files[3].size;
        if (sizeFoto_4 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
          return;
          }
      }
      if(number_of_images==5){
        var sizeFoto_5 = $(this).get(0).files[4].size;
        if (sizeFoto_5 > 2097152) {
          alert('Error: No se puede subir fotos de más de 2 MB.');
          $(this).val('');
          return;
          }
      }
      @endif  
    });
  });
  </script>
  @endsection