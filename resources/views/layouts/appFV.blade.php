<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png?1') }}">
  <!-- Place favicon.ico in the root directory -->
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('fv/css/open-iconic-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/animate.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/aos.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/bootstrap-datepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/jquery.timepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/flaticon.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/icomoon.css')}}">
  <link rel="stylesheet" href="{{ asset('fv/css/style.css?10')}}">
    @yield('head_scripts')
  <style>
  ::placeholder {
    color: lightgray !important;
  }
  </style>
</head>
<body>
  @yield('modal_confirm')
  <!-- header-start -->
  <nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar" style="">
    <div class="container">
      <a class="navbar-brand" href="{{url('/home')}}"><img src="{{asset('img/logo-mini.png')}}" style="width: 100%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          @if(isset($stands))
          <li class="nav-item">Stand:
            <select id="stand_seleccionado" onchange="stand()">
            @foreach ($stands as $st)
              <option value="{{$st->id_stand}}" @if($sel==$st->id_stand) selected @endif>{{$st->nombre}}</option>
            @endforeach  
            </select>
          </li>
          @endif
          @handheld
          <li class="nav-item active"><a href="{{url('/home')}}" class="nav-link">Inicio</a></li>
            @if($menu)
              @if(isset($stands))
                <li class="nav-item"><a href="#modificar_empresa" class="nav-link">Datos de Empresa</a></li>
                <li class="nav-item"><a href="#modificar_productos" class="nav-link">Productos</a></li>
                <li class="nav-item"><a href="#modificar_ofertas" class="nav-link">Ofertas</a></li>
                <li class="nav-item"><a href="#modificar_ejecutivos" class="nav-link">Ejecutivos</a></li>
                <li class="nav-item cta mr-md-2"><a href="{{url('/previa_stand/'.$sel)}}" class="nav-link">Ver mi stand</a></li>
              @else
                <li class="nav-item"><a href="#modificar_empresa" class="nav-link">Datos de Empresa</a></li>
                <li class="nav-item"><a href="#modificar_productos" class="nav-link">Productos</a></li>
                <li class="nav-item"><a href="#modificar_ofertas" class="nav-link">Ofertas</a></li>
                <li class="nav-item"><a href="#modificar_ejecutivos" class="nav-link">Ejecutivos</a></li>
                <li class="nav-item"><a href="#modificar_stand" class="nav-link">Personalizar Stand</a></li>
                <li class="nav-item cta mr-md-2"><a href="{{url('/previa_stand')}}" class="nav-link">Ver mi stand</a></li>
              @endif
            @endif
            <li class="nav-item cta mr-md-2"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Salir</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          @elsehandheld
          <li class="nav-item active" @if($menu) style="max-width: 15%" @endif><a href="{{url('/home')}}" class="nav-link">Inicio</a></li>
            @if($menu)
              @if(isset($stands))
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_empresa" class="nav-link">Datos de Empresa</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_productos" class="nav-link">Productos</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_ofertas" class="nav-link">Ofertas</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_ejecutivos" class="nav-link">Ejecutivos</a></li>
                <li class="nav-item cta mr-md-2" style="max-width: 15%"><a href="{{url('/previa_stand/'.$sel)}}" class="nav-link">Ver mi stand</a></li>
              @else
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_empresa" class="nav-link">Datos de Empresa</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_productos" class="nav-link">Productos</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_ofertas" class="nav-link">Ofertas</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_ejecutivos" class="nav-link">Ejecutivos</a></li>
                <li class="nav-item" style="max-width: 15%"><a href="#modificar_stand" class="nav-link">Personalizar Stand</a></li>
                <li class="nav-item cta mr-md-2" style="max-width: 15%"><a href="{{url('/previa_stand')}}" class="nav-link">Ver mi stand</a></li>
              @endif
            @endif
          <li class="nav-item cta mr-md-2" @if($menu) style="max-width: 15%" @endif><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Salir</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
          @endhandheld
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
  @if(!isset($slider))
  <div class="hero-wrap{{isset($clase) ? '1' : ''}}" style="background-image: url({{asset('fv/images/banner3.jpg?1')}});background-size:auto;background-repeat:repeat" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container{{isset($clase) ? '1' : ''}}">
      <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
        <div class="col-lg-12 col-md-12 mt-0 mt-md-12">
          <div class="request-form1 ftco-animate">
            @yield('content')
          </div>
          <!--<form action="#" class="request-form ftco-animate">
          <h2>Join Conference</h2>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter your Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter your Email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter your Phone">
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" value="Join now" class="btn btn-primary py-3 px-4">
          </div>
          </form>-->
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- header-end -->
  @yield('stand')
  @yield('body')
  <!-- footer_start -->
  <footer class="ftco-footer ftco-bg-dark ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Consultas sobre la plataforma</h2>
            <div class="block-23 mb-3">
              <ul>
                <li ><span class="text">Javier Cárdenas</span></li>
                <li><a href="https://wa.me/59167599668?text=Tengo%20dudas%20sobre%20la%20plataforma" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">67599668</a></span></li>
                <li><a href="mailto:jcardenas@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">jcardenas@feicobol.com.bo</a></span></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2" style="text-align: center">Consultas Comerciales</h2>
            <div class="row">
              <div class="block-23 col-md-4">
                <ul>
                  <li><span class="text">Andrea Flores</span></li>
                  <li><a href="https://wa.me/59172207063?text=Tengo%20dudas%20sobre%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72207063</a></span></li>
                  <li><a href="mailto:aflores@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">aflores@feicobol.com.bo</a></span></li>
                </ul>
              </div>
              <div class="block-23 col-md-4">
                <ul>
                  <li><span class="text">Juan Kent</span></li>
                  <li><a href="https://wa.me/59172206073?text=Tengo%20dudas%20sobre%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72206073</a></span></li>
                  <li><a href="mailto:jkent@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">jkent@feicobol.com.bo</a></span></li>
                </ul>
              </div>
              <div class="block-23 col-md-4">
                <ul>
                  <li><span class="text">Pamela Arze</span></li>
                  <li><a href="https://wa.me/59172241462?text=Tengo%20dudas%20sobre%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72241462</a></span></li>
                  <li><a href="mailto:parze@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">parze@feicobol.com.bo</a></span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <a href="https://www.feicobol.com.bo">FEICOBOL</a> &copy;<script>document.write(new Date().getFullYear());</script> | Powered by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <!-- Scripts -->
  <!-- JS here -->
  <script src="{{asset('fv/js/jquery.min.js')}}"></script>
  <script src="{{asset('fv/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('fv/js/popper.min.js')}}"></script>
  <script src="{{asset('fv/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('fv/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('fv/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('fv/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('fv/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('fv/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('fv/js/aos.js')}}"></script>
  <script src="{{asset('fv/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('fv/js/scrollax.min.js')}}"></script>
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  @yield('scripts');
  @if(isset($stands))
  <script>
    function stand(){
      sel=$('#stand_seleccionado').val();
      @if(Route::input('stand')>0)
        x="{{route(substr(Route::currentRouteName(),0,-1))}}/"+sel;
      @else
        x="{{route(Route::currentRouteName())}}/"+sel;
      @endif
      window.location.href = x;
    }
  </script>
  @endif
  <script src="{{asset('fv/js/main.js?2')}}"></script></body>
</html>