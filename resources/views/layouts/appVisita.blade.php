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
  <link rel="stylesheet" href="{{ asset('fv/css/style.css?12')}}">
  @yield('head_scripts')
  @handheld
  <style>
    .popover h3 {
      font-size: xx-small !important;
  }
  </style>
  @if(isset($height))
  <style>
    @media (min-width: 320px){
      .hero-wrap{
        height: {{$height}}px !important;
      }
    } 
    @media (min-width: 375px){
      .hero-wrap{
        height: {{$height+30}}px !important;
      }
    } 
    @media (min-width: 425px){
      .hero-wrap{
        height: {{$height+60}}px !important;
      }
    } 
    @media (min-width: 760px){
      .hero-wrap{
        height: {{$height+230}}px !important;
      }
    } 
    @media (min-width: 1024px){
      .hero-wrap{
        height: {{$height+370}}px !important;
      }
    } 
    @media (min-width: 1440px){
      .hero-wrap{
        height: {{$height+590}}px !important;
      }
    } 
  </style>  
  @endif
  @endhandheld
  @desktop
  @if(isset($height_desk))
  <style>
    @media (min-width: 768px){
      .hero-wrap{
        height: {{$height_desk}}px !important;
      }
    } 
  </style>  
  @endif
  @enddesktop
  <style>
  ::placeholder {
    color: lightgray !important;
  }    
  </style>
</head>
<body>
  @yield('modal_confirm')
  <!-- header-start -->
  <nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar" style="top:0px !important">
    <div class="container @mobile row @endmobile">
      <a class="@mobile col-md-4 @elsemobile navbar-brand @endmobile" href="{{url('/home')}}"><img src="{{asset('img/logo-mini.png')}}" height="60px"></a>
      @if(isset($title))
        @mobile
          <h4 class="col-md-8" style="flex:100%;font-size: medium;color:white">{{$title}}</h4>
          <span style="font-size:x-small;color:white">Puedes hacer clic en el plano o también en la información que se encuentra debajo</span>
          @if(isset($mapa) || isset($pabellon))
            @if(isset($mapa) && $mapa)
              <a class="btn btn-info" style="font-size:xx-small" href="{{route('visita')}}">Volver al mapa</a>
            @elseif(isset($pabellon))
              <a class="btn btn-info" style="font-size:xx-small" href="{{route('pabellon',['pabellon'=>$pabellon])}}">Volver al pabellon</a>
              @endif
          @endif
        @elsemobile
        <h3 style="color: white">{{$title}}</h3>
        @if(isset($mapa) && $mapa)
          <a class="btn btn-info" href="{{route('visita')}}">Volver al mapa</a>
        @endif
          @if(isset($pabellon))
          <a class="btn btn-info" href="{{route('pabellon',['pabellon'=>$pabellon])}}">Volver al pabellon</a>
          @endif
        @endmobile
      @endif
      <div class="collapse navbar-collapse" id="ftco-nav"></div>
    </div>
  </nav>
  <!-- END nav -->
  @if(!isset($nohero))
  <div class="hero-wrap" style="background-image: url({{asset('img/Frontis.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    @yield('content')
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
  @endif
  <!-- header-end -->
  @yield('stand')
  @yield('body')
  <!-- footer_start -->
  <footer class="ftco-footer ftco-bg-dark ">
    <div class="container">
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
  <script src="{{asset('fv/js/main.js?2')}}"></script>
</body>
</html>
