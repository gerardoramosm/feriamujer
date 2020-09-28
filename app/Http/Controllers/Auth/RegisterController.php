<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registrado';
    public $tipo=0;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'g-recaptcha-response' => 'required|captcha',
            'nombre_empresa' => 'required|string|max:255',
            'nombre_responsable' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'nit' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $cantidad=DB::table('empresas as e')
        ->leftJoin(DB::raw("(SELECT * FROM fv_solicitud WHERE codigo_fv=6) as f"),function($join){
            $join->on('f.id_empresa','=','e.id_empresa');
        })
//        ->leftjoin('fv_solicitud as f','f.id_empresa','=','e.id_empresa')
        ->where('e.nit',$data['nit'])->select('e.id_empresa','f.fecha_solicitud','f.estado','e.email','f.codigo_fv')->first();
        if(isset($cantidad))
        {
            if(!is_null($cantidad->estado))
            {
                if($cantidad->estado==0)
                    $this->tipo='1';
                else
                    $this->tipo='2';
            }
            else{
                if($cantidad->id_empresa>0)
                {
                    DB::table('empresas')->where('id_empresa',$cantidad->id_empresa)
                    ->update([
                        'nombre_empresa'=>$data['nombre_empresa'],
                        'email'=>($cantidad->email == '' || $cantidad->email==$data['email']) ? $cantidad->email : $data['email'],
                        'pass'=>$data['password'],
                        'telefono'=>$data['telefono'],
                        'nombre_responsable'=>$data['nombre_responsable'],
                        'telefono_responsable'=>$data['telefono'],
                        'lat'=>-17.3930281,
                        'lon'=>-66.1523097,
                        'email_representante'=>$data['email'],
                        'es_activo'=>'1'
                    ]);
                    $emp=DB::table('empresas')->where('nit',$data['nit'])->select('id_empresa')->first();
                    $prods='';
                    if($data['cantidad']==1)
                        $prods=$data['nombre_stand'][0].": ".$data['productos'][0];
                    DB::table('fv_solicitud')->insert(['stands'=>$data['cantidad'],'precio'=>($data['cantidad']*$data['tipo']),'id_empresa'=>$emp->id_empresa,'productos'=>$prods,'fecha_solicitud'=>date('Y-m-d'),'estado'=>0,'tipo'=>$data['tipo'],'codigo_fv'=>6,'nit_factura'=>$data['nit_factura'],'razon_social'=> $data['razon_social'],'descripcion'=>'','fecha_aceptacion'=>date('Y-m-d'),'encuentro'=>$data['encuentro']]);
                    $emails = ['aflores@feicobol.com.bo','parze@feicobol.com.bo','jkent@feicobol.com.bo','jcardenas@feicobol.com.bo'];
//                    $emails = ['jcardenas@feicobol.com.bo'];
                    Mail::send('email.solicitud_feicobol',['data'=>$data],function($m) use ($emails,$data){
                        $m->subject('Solicitud de Inscripción - Empresa '.$data['nombre_empresa']);
                        $m->to($emails);
                        });
                    $emails = [$data['email']];
                    Mail::send('email.solicitud_cliente',['data'=>$data],function($m) use ($emails){
                        $m->subject('Solicitud de Inscripción Recibida');
                        $m->to($emails);
                        });
                    if($data['cantidad'] > 1)
                    {
                        for($i=0;$i<$data['cantidad'];$i++)
                            DB::table('fv_stand')->insert(
                                ['id_user'=>$emp->id_empresa,
                                'nombre'=>$data['nombre_stand'][$i],
                                'cod_fv'=>'6',
                                'direccion'=>'',
                                'lat'=>-17.3930281,
                                'lon'=>-66.1523097,
                                'telefono'=>$data['telefono'],
                                'email'=>$data['email'],
                                'web'=>'',
                                'descripcion'=>$data['productos'][$i],
                                'pais'=>'123',
                                'ciudad'=>'540852',
                                'persona_contacto'=>$data['nombre_responsable'],
                                'telefono_contacto'=>$data['telefono'],
                                'email_contacto'=>$data['email'],
                                'wpp'=>'',
                                'ig'=>'',
                                'fb'=>'',
                                'video'=>'',
                                'logo'=>'',
                                ]
                            );
                    }
                }
            }
        }
        else
        {
            User::create([
                'nombre_empresa' => $data['nombre_empresa'],
                'email' => $data['email'],
                'pass' => $data['password'],
                'direccion'=>'',
                'telefono'=>$data['telefono'],
                'fax'=>'',
                'web'=>'',
                'nit'=>$data['nit'],
                'pais'=>'123',
                'ciudad'=>'540852',
                'aniversario'=>'1900-01-01',
                'cluster'=>'4',
                'categoria'=>0,
                'rubro'=>0,
                'desc_producto'=>'',
                'nombre_gerente'=>'',
                'ci_gerente'=>'',
                'exp_ci_gerente'=>'',
                'fono_gerente'=>'',
                'cargo_gerente'=>'',
                'nombre_responsable'=>$data['nombre_responsable'],
                'ci_responsable'=>'',
                'exp_ci_responsable'=>'',
                'telefono_responsable'=>$data['telefono'],
                'email_representante'=>$data['email'],
                'id_tipo_representante'=>'0',
                'otro_rubro'=>'',
                'subrubro'=>'0',
                'lat'=>-17.3930281,
                'lon'=>-66.1523097,
                'paises_representante'=>'',
                'empresa_representante'=>'',
                'marcas_representante'=>'',
                'pendiente_llenado'=>'',
                'usuario'=>'',
                'ejecutivo'=>'0',
                'fecha_asignacion'=>'1900-01-01',
                'fecha_creacion'=>date('Y-m-d'),
                'fecha_actualizacion_empresa'=>'1900-01-01',
                'id_usuario_creacion'=>'0',
                'id_usuario_actualizacion'=>'0',
                'remember_token'=>'',
                'es_activo'=>'1'
                ]);
        $emp=DB::table('empresas')->where('nit',$data['nit'])->select('id_empresa')->first();
        $prods='';
        if($data['cantidad']==1)
            $prods=$data['nombre_stand'][0].": ".$data['productos'][0];
        DB::table('fv_solicitud')->insert(['stands'=>$data['cantidad'],'precio'=>($data['cantidad']*$data['tipo']),'id_empresa'=>$emp->id_empresa,'productos'=>$prods,'fecha_solicitud'=>date('Y-m-d'),'estado'=>0,'tipo'=>$data['tipo'],'codigo_fv'=>6,'nit_factura'=>$data['nit_factura'],'razon_social'=> $data['razon_social'],'descripcion'=>'','fecha_aceptacion'=>date('Y-m-d'),'encuentro'=>$data['encuentro']]);
        $emails = ['aflores@feicobol.com.bo','parze@feicobol.com.bo','jkent@feicobol.com.bo','jcardenas@feicobol.com.bo'];
//        $emails = ['jcardenas@feicobol.com.bo'];
        Mail::send('email.solicitud_feicobol',['data'=>$data],function($m) use ($emails,$data){
            $m->subject('Solicitud de Inscripción - Empresa '.$data['nombre_empresa']);
            $m->to($emails);
            });
        $emails = [$data['email']];
        Mail::send('email.solicitud_cliente',['data'=>$data],function($m) use ($emails){
            $m->subject('Solicitud de Inscripción Recibida');
            $m->to($emails);
            });
        if($data['cantidad'] > 1)
        {
            for($i=0;$i<$data['cantidad'];$i++)
                DB::table('fv_stand')->insert(
                    ['id_user'=>$emp->id_empresa,
                    'cod_fv'=>'6',
                    'nombre'=>$data['nombre_stand'][$i],
                    'direccion'=>'',
                    'lat'=>-17.3930281,
                    'lon'=>-66.1523097,
                    'telefono'=>$data['telefono'],
                    'email'=>$data['email'],
                    'web'=>'',
                    'descripcion'=>$data['productos'][$i],
                    'pais'=>'123',
                    'ciudad'=>'540852',
                    'persona_contacto'=>$data['nombre_responsable'],
                    'telefono_contacto'=>$data['telefono'],
                    'email_contacto'=>$data['email'],
                    'wpp'=>'',
                    'ig'=>'',
                    'fb'=>'',
                    'video'=>'',
                    'logo'=>'',
                    ]
                );
        }
    }
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    
        event(new Registered($user = $this->create($request->all())));
    
//            $this->guard()->login($user);
        return view('auth.register-success')->with('tipo', $this->tipo);
    
        //return redirect($this->redirectPath());
    }
}
