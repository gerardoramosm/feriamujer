<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'empresas';
    protected $primaryKey='id_empresa';

    protected $fillable = [
        'nombre_empresa', 
        'direccion', 
        'telefono',
        'fax',
        'email',
        'web',
        'nit',
        'pais',
        'ciudad',
        'aniversario',
        'cluster',
        'categoria',
        'rubro',
        'desc_producto',
        'nombre_gerente',
        'ci_gerente',
        'exp_ci_gerente',
        'fono_gerente',
        'cargo_gerente',
        'nombre_responsable',
        'ci_responsable',
        'exp_ci_responsable',
        'telefono_responsable',
        'email_representante',
        'id_tipo_representante',
        'otro_rubro',
        'subrubro',
        'paises_representante',
        'empresa_representante',
        'marcas_representante',
        'pendiente_llenado',
        'usuario',
        'pass',
        'lat',
        'lon',
        'ejecutivo',
        'fecha_asignacion',
        'fecha_creacion',
        'fecha_actualizacion_empresa',
        'id_usuario_creacion',
        'id_usuario_actualizacion',
        'remember_token',
        'es_activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {//dd($this->email_representante);
        return $this->email_representante;
    }
    public function routeNotificationForMail()
    {
        return $this->email_representante;
    }


}
