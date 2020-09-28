@extends('layouts.app',['vals'=>true])

@section('content')
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="title_text title_text2 ">
                            <h3>Loguearse</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('nit') ? ' has-error' : '' }}">
                                            <label  for="nit" class="col-md-10 control-label">NIT de la empresa</label>
                
                                            <div class="col-md-10">
                                                <input id="nit" type="text" class="form-control" name="nit" value="{{ old('nit') }}" required autofocus>
                
                                                @if ($errors->has('nit'))
                                                    <div class="alert alert-danger">
                                                        <strong>{{ $errors->first('nit') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                
                                        <div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
                                            <label for="pass"  class="col-md-10 control-label">Contraseña</label>
                
                                            <div class="col-md-10">
                                                <input id="pass" type="password" class="form-control" name="pass" required>
                
                                                @if ($errors->has('pass'))
                                                    <div class="alert alert-danger">
                                                        <strong>{{ $errors->first('pass') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Ingresar
                                                </button>
                                                <a class="btn btn-info" href="{{ route('password.request') }}">
                                                    Recuperar contraseña
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('head_scripts')
<style>
    label{
        color: white;
        font-weight: bold;
    }
</style>
@endsection