@extends('layouts.app',['vals'=>true])
@section('content')
<div class="slider_area slider_bg_1">
    <div class="slider_text">
        <div class="container">
            <div class="position_relv">
                <div class="row">
                    <div class="col-xl-7 col-lg-7">
                        <div class="title_text title_text2 ">
                            <h3>Recupera tu Contraseña</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label  for="email_representante" class="col-md-10 control-label">Correo Electrónico</label>
                                            <div class="col-md-12">
                                                <input id="email_representante" type="email" class="form-control" name="email_representante" value="{{ $email or old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="pass"  class="col-md-10 control-label">Nueva Contraseña</label>
                                            <div class="col-md-12">
                                                <input id="pass" type="password" class="form-control" name="pass" required>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="pass-confirm"  class="col-md-10 control-label">Confirmar nueva contraseña</label>
                                            <div class="col-md-12">
                                                <input id="pass-confirm" type="password" class="form-control" name="pass_confirmation" required>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>                
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Cambia la contraseña
                                                </button>
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