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
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label  for="nit" class="col-md-10 control-label">NIT de la empresa</label>
                                        <div class="input-group-icon mt-10">
                                            <input id="nit" type="text" class="single-input" name="nit" value="{{ old('nit') }}" required>
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-5 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Envíame un e-mail
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