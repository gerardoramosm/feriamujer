@extends('layouts.appFV',['menu'=>$menu,'link'=>$link])
@section('head_scripts')
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
@section('content')
  <div class="container">
    <div class="row">
      <div class="{{isset($pago) ? 'col-md-8' : 'col-md-12'}}">
        <div class="panel panel-default ">
          <div class="panel-body p-3 ">
            <h2 style="text-align: center">Bienvenido a la página principal de la empresa<br>elija una de las acciones a realizar</h2>
            <div class="row">
              <div class="col-md-4 contenedor">
                <a href="{{url('/empresa')}}">
                  <img src="{{url('img/empresa.png')}}" alt="Empresa" style="width: 100%" class="image">
                  <div class="overlayed">
                    <div class="textu">Registre aquí los datos de la empresa</div>
                  </div>
                </a>
              </div>
              <div class="col-md-4 contenedor">
                <a href="{{url('/productos')}}">
                  <img src="{{url('img/producto.png')}}" alt="Producto" style="width: 100%" class="image">
                  <div class="overlayed">
                    <div class="textu">Registre aquí sus productos</div>
                  </div>
                </a>
              </div>
              <div class="col-md-4 contenedor">
                <a href="{{url('/ofertas')}}">
                  <img src="{{url('img/oferta.png')}}" alt="Oferta" style="width: 100%" class="image">
                  <div class="overlayed">
                    <div class="textu">Registre aquí sus ofertas</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
