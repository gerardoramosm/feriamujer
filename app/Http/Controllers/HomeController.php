<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use Fpdf;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['el_evento','actividades_paralelas','organizadores','quiero_participar','login_sistema','visita','mapa','auditorio','teatro','pabellon','visita_stand']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home_stand($stand){
        $enc=DB::table('fv_encuesta')->where('cod_fv',7)->where('id_user',$stand)->count();
        if($enc==0)
            {
                $sol=DB::table('fv_solicitud')->where('codigo_fv',6)->where('id_empresa',Auth::user()->id_empresa)->where('estado',1)->first();
                $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
                $sstand=DB::table('fv_stand')->where('id_stand',$stand)->first();
                $sucs=DB::table('fv_sucursal')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
                $pais=DB::table('paises')->where('id',$sstand->pais)->select('nombre')->first();
                $ciudad=DB::table('localidades')->where('id',$sstand->ciudad)->select('nombre')->first();
                $paises=DB::table('paises')->get();
                $ciudades=DB::table('localidades')->where('id_pais',$sstand->pais)->get();
                $ofertas=DB::table('fv_oferta')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
                $prod=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
                $ejecutivos=DB::table('fv_ejecutivo')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
                if(date('Y-m-d H:i')<='2020-09-24 00:00')
                    return view('plataforma.dashboard2_multi',["sol"=>$sstand,'menu'=>true,'stands'=>$stands,'sel'=>$stand,'ofertas'=>$ofertas,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>0]);        
                else
                    return view('plataforma.dashboard2_multi',["sol"=>$sstand,'menu'=>true,'stands'=>$stands,'sel'=>$stand,'ofertas'=>$ofertas,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>1]);        
            }
        else
        {
            $sol=DB::table('fv_solicitud')->where('codigo_fv',6)->where('id_empresa',Auth::user()->id_empresa)->where('estado',1)->first();
            $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
            $sstand=DB::table('fv_stand')->where('id_stand',$stand)->first();
            $sucs=DB::table('fv_sucursal')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
            $pais=DB::table('paises')->where('id',$sstand->pais)->select('nombre')->first();
            $ciudad=DB::table('localidades')->where('id',$sstand->ciudad)->select('nombre')->first();
            $paises=DB::table('paises')->get();
            $ciudades=DB::table('localidades')->where('id_pais',$sstand->pais)->get();
            $ofertas=DB::table('fv_oferta')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
            $prod=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
            $ejecutivos=DB::table('fv_ejecutivo')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$sstand->id_stand)->where('es_activo',1)->get();
            return view('plataforma.dashboard2_multi',["sol"=>$sol,'ofertas'=>$ofertas,'menu'=>true,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>2]);
        }
    }
    public function index()
    {
        $sol=DB::table('fv_solicitud')->where('codigo_fv',7)->where('id_empresa',Auth::user()->id_empresa)->where('estado',1)->first();
        if(is_null($sol->fecha_aceptacion))
        {
            $pais=DB::table('paises')->orderBy('nombre','ASC')->get();
            $ciudad=DB::table('localidades')->where('id_pais',Auth::user()->pais)->orderBy('nombre','ASC')->get();
            return view('plataforma.contrato',["sol"=>$sol,'menu'=>false,'paises'=>$pais,'ciudades'=>$ciudad]);
        //debe llenar datos del contrato y aceptar terminos y condiciones
        }
        else
        {
            $pago=DB::table('pago')->where('id_empresa',Auth::user()->id_empresa)->where('id_feria',0)->where('cod_fv',7)->get();
            //datos llenos, confirmar pago
            //hacer query de pagos para verificar si subió o no un comprobante
            if($sol->estado_pago==0)
            {
                if($pago->isNotEmpty()){
                    return view('plataforma.pago',["sol"=>$sol,'menu'=>false,'pago'=>$pago]);}
                else{
                    return view('plataforma.pago',["sol"=>$sol,'menu'=>false]);}
            }
            else
            {
                if($sol->stands==1)
                {
                    $sucs=DB::table('fv_sucursal')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
                    $pais=DB::table('paises')->where('id',Auth::user()->pais)->select('nombre')->first();
                    $ciudad=DB::table('localidades')->where('id',Auth::user()->ciudad)->select('nombre')->first();
                    $paises=DB::table('paises')->get();
                    $ciudades=DB::table('localidades')->where('id_pais',Auth::user()->pais)->get();
                    $ofertas=DB::table('fv_oferta')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
                    $prod=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
                    $ejecutivos=DB::table('fv_ejecutivo')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
                    if(date('Y-m-d H:i')<='2020-09-31 00:00'){
                        return view('plataforma.dashboard2',["sol"=>$sol,'ofertas'=>$ofertas,'menu'=>true,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>0]);
                    }
                    else
                    {
                        $n=DB::table('fv_encuesta')->where('id_user',Auth::user()->id_empresa)->where('cod_fv',7)->count();
                        if($n==0)
                            return view('plataforma.dashboard2',["sol"=>$sol,'ofertas'=>$ofertas,'menu'=>true,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>1]);
                        else
                            return view('plataforma.dashboard2',["sol"=>$sol,'ofertas'=>$ofertas,'menu'=>true,'productos'=>$prod,'ejecutivos'=>$ejecutivos,'sucs'=>$sucs,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$sol->meet_link,'encuesta'=>2]);
                    }
                }
                else
                {
                    $stands=DB::table('fv_stand')->where('cod_fv',7)->where('id_user',Auth::user()->id_empresa)->get();
                    return redirect('home/'.$stands[0]->id_stand);
//                    return view('plataforma.dashboard2',["sol"=>$sol,'menu'=>true,'stands'=>$stands,'sel'=>$stands[0]->id_stand,'link'=>$stands[0]->meet_link]);
                }
                //pago confirmado, dashboard
            }
        }
//        return view('home');
    }
    public function el_evento(){
        return view('publicos.evento');
    }
    public function actividades_paralelas(){
        return view('publicos.actividades');
    }
    public function organizadores(){
        return view('publicos.organizadores');
    }
    public function quiero_participar(){
        return view('publicos.participar');
    }
    public function contrato(Request $request){
        if($request->aceptacion)
        {
            $user = Auth::user();
            $user->direccion=$request->direccion;
            $user->telefono=$request->telefono;
            $user->email=$request->email;
            $user->pais=$request->pais;
            $user->ciudad=$request->ciudad;
            $user->web=is_null($request->web) ? '' : $request->web;
            $user->lat=$request->lat;
            $user->lon=$request->lon;
            $user->save();
            DB::table('fv_solicitud')->where('id_solicitud',$request->id_solicitud)
            ->update([
                'razon_social'=>$request->razon_social,
                'nit_factura'=>$request->nit_factura,
                'descripcion'=>$request->descripcion,
                'wpp'=>$request->wpp,
                'ig'=>$request->ig,
                'fb'=>$request->fb,
                'fecha_aceptacion'=>date('Y-m-d')
                ]);
            return redirect('home')->with('status','confirmaContrato');
            }
        else
        {
            if($request->ciudad!=Auth::user()->ciudad)
            {
                $ciudad=DB::table('localidades')->where('id_pais',$request->pais)->orderBy('nombre','ASC')->get();
                $request->request->add(['cita'=>$ciudad]);
                return redirect()->back()->withInput($request->all);
            }
            else                        
                return redirect()->back()->withInput($request->all);
        }
    }            
    public function pago(Request $request)
    {
//        dd(dirname(base_path()).'/sistema/public/img/pagos');
        $ext=request()->foto->getClientOriginalExtension();
        if($ext=='jpg')
            $id=DB::table('pago')->insertGetId(['id_empresa'=>Auth::user()->id_empresa,'id_feria'=>0,'cod_fv'=>6,'tipo_pago'=>0,'monto'=>$request->monto,'fecha'=>date('Y-m-d'),'estado'=>0,'id_usuario'=>0,'id_aprobacion'=>0]);
        else
            $id=DB::table('pago')->insertGetId(['id_empresa'=>Auth::user()->id_empresa,'id_feria'=>0,'cod_fv'=>6,'tipo_pago'=>0,'monto'=>$request->monto,'fecha'=>date('Y-m-d'),'estado'=>0,'id_usuario'=>0,'id_aprobacion'=>0,'extension'=>$ext]);
//        request()->image->move(public_path('images'), $imageName);
        $imageName = $id.'.'.$ext;
        request()->foto->move(dirname(base_path()).'/sistema/public/img/pagos', $imageName);
//        $emails = ['jcardenas@feicobol.com.bo'];
        $emails = ['ebotello@feicobol.com.bo','aflores@feicobol.com.bo','jcardenas@feicobol.com.bo'];
        $user=Auth::user();
        Mail::send('email.pago',['data'=>$request->monto,'empresa'=>$user->nombre_empresa],function($m) use ($emails,$user){
            $m->subject('Comprobante de Pago Subido - Empresa '.$user->nombre_empresa);
            $m->to($emails);
            });
        return redirect('home')->with('status','confirmaPago');
    }
    public function login_sistema($id){
        $val=explode(";",base64_decode($id));
        if(isset(Auth::user()->id_empresa))
            Auth::logout();
        Auth::loginUsingId($val[1]*1);
        if(Auth::user()->id_empresa==$val[1])
            return redirect('home');
        else
            return redirect('login');
    }
    public function datos_empresa(){
        $sucs=DB::table('fv_sucursal')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
        $datos=DB::table('fv_solicitud')->where('id_empresa',Auth::user()->id_empresa)->where('codigo_fv',6)->first();
        $pais=DB::table('paises')->where('id',Auth::user()->pais)->select('nombre')->first();
        $ciudad=DB::table('localidades')->where('id',Auth::user()->ciudad)->select('nombre')->first();
        $paises=DB::table('paises')->get();
        $ciudades=DB::table('localidades')->where('id_pais',Auth::user()->pais)->get();
        return view('plataforma.empresa',['menu'=>true,'sucs'=>$sucs,'d'=>$datos,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'link'=>$datos->meet_link]);
    }
    public function datos_empresa_stand($stand){
        $datos=DB::table('fv_stand')->where('id_stand',$stand)->first();
        $sucs=DB::table('fv_sucursal')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$stand)->where('es_activo',1)->get();
        $pais=DB::table('paises')->where('id',$datos->pais)->select('nombre')->first();
        $ciudad=DB::table('localidades')->where('id',$datos->ciudad)->select('nombre')->first();
        $paises=DB::table('paises')->get();
        $ciudades=DB::table('localidades')->where('id_pais',$datos->pais)->get();
        $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
        return view('plataforma.empresa_stand',['menu'=>true,'sucs'=>$sucs,'d'=>$datos,'ciud'=>$ciudad->nombre,'pais'=>$pais->nombre,'paises'=>$paises,'ciudades'=>$ciudades,'sel'=>$stand,'stands'=>$stands,'link'=>$stands[0]->meet_link]);
    }
    public function guardar_datos_empresa(Request $request){
        DB::table('fv_solicitud')->where('id_solicitud',$request->solicitud)->update([
            'descripcion'=>$request->descripcion,
            'nombre_stand'=>$request->nombre_stand,
            'wpp'=>$request->wpp,
            'ig'=>$request->ig,
            'fb'=>$request->fb,
            'tw'=>$request->tw,
            'yt'=>$request->yt,
            'video'=>$request->video,
            'video2'=>$request->video2,
            'videochat'=>($request->videochat ? 1 : 0),
            'video_inicio'=>($request->videochat ? $request->video_inicio : ''),
            'video_fin'=>($request->videochat ? $request->video_fin : '')
        ]);
        if(is_null($request->web))
            $request->web='';
        $user=Auth::user();
        $user->direccion=$request->direccion;
        $user->telefono=$request->telefono;
        $user->email=$request->email;
        $user->web=$request->web;
        $user->pais=$request->pais;
        $user->ciudad=$request->ciudad;
        $user->nombre_responsable=$request->nombre_responsable;
        $user->telefono_responsable=$request->telefono_responsable;
        $user->email_representante=$request->email_representante;
        $user->save();
        if(isset(request()->logo)){
            if(file_exists(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa.".jpg"))
                unlink(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa.".jpg");
            request()->logo->move(dirname(base_path()).'/expositores/public/images/logos',Auth::user()->id_empresa.".jpg");
        }
        return redirect()->back()->with('status', 'Se guardaron los datos correctamente!');
    }
    public function guardar_datos_empresa_stand($stand, Request $request){
        DB::table('fv_stand')->where('id_stand',$stand)->update([
            'nombre'=>$request->nombre,
            'direccion'=>$request->direccion,
            'telefono'=>$request->telefono,
            'email'=>$request->email,
            'web'=>$request->web,
            'pais'=>$request->pais,
            'ciudad'=>$request->ciudad,
            'persona_contacto'=>$request->persona_contacto,
            'telefono_contacto'=>$request->telefono_contacto,
            'email_contacto'=>$request->email_contacto,
            'descripcion'=>$request->descripcion,
            'wpp'=>$request->wpp,
            'ig'=>$request->ig,
            'fb'=>$request->fb,
            'tw'=>$request->tw,
            'yt'=>$request->yt,
            'video'=>$request->video,
            'video2'=>$request->video2,
            'videochat'=>($request->videochat ? 1 : 0),
            'video_inicio'=>($request->videochat ? $request->video_inicio : ''),
            'video_fin'=>($request->videochat ? $request->video_fin : '')
        ]);
        if(isset(request()->logo)){
            if(file_exists(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa."_".$stand.".jpg"))
                unlink(dirname(base_path()).'/expositores/public/images/logos/'.Auth::user()->id_empresa."_".$stand.".jpg");
            request()->logo->move(dirname(base_path()).'/expositores/public/images/logos',Auth::user()->id_empresa."_".$stand.".jpg");
        }
        return redirect()->back()->with('status', 'Se guardaron los datos correctamente!');
    }
    public function guardar_sucursales(Request $request){
        if($request->identificador=='N'){
            DB::table('fv_sucursal')->insert([
                'lat'=>$request->lat,
                'lon'=>$request->lon,
                'address'=>$request->direccion_sucursal,
                'telefono'=>$request->telefono_sucursal,
                'caracteristicas'=>preg_replace( "/\r|\n/", "", nl2br($request->caracteristicas_sucursal)),
                'es_activo'=>1,
                'id_user'=>Auth::user()->id_empresa
            ]);
            return redirect()->back()->with('status', 'Se creó la sucursal correctamente!');
        }
        else{
            if($request->identificador==0)
                DB::table('empresas')->where('id_empresa',Auth::user()->id_empresa)->update([
                    'lat'=>$request->lat,
                    'lon'=>$request->lon,
                    'direccion'=>$request->direccion_sucursal
                    ]);
            else
                DB::table('fv_sucursal')->where('id_sucursal',$request->identificador)->update([
                    'lat'=>$request->lat,
                    'lon'=>$request->lon,
                    'address'=>$request->direccion_sucursal,
                    'telefono'=>$request->telefono_sucursal,
                    'caracteristicas'=>preg_replace( "/\r|\n/", "", nl2br($request->caracteristicas_sucursal)),
                    'es_activo'=>1,
                    'id_user'=>Auth::user()->id_empresa
                ]);
            return redirect()->back()->with('status', 'Se actualizaron los datos de la sucursal correctamente!');
        }
    }
    public function guardar_sucursales_stand($stand,Request $request){
        if($request->identificador=='N'){
            DB::table('fv_sucursal')->insert([
                'lat'=>$request->lat,
                'lon'=>$request->lon,
                'address'=>$request->direccion_sucursal,
                'telefono'=>$request->telefono_sucursal,
                'caracteristicas'=>preg_replace( "/\r|\n/", "",nl2br($request->caracteristicas)),
                'es_activo'=>1,
                'id_stand'=>$stand,
                'id_user'=>Auth::user()->id_empresa
            ]);
            return redirect()->back()->with('status', 'Se creó la sucursal correctamente!');
        }
        else{
            DB::table('fv_sucursal')->where('id_sucursal',$request->identificador)->update([
                'lat'=>$request->lat,
                'lon'=>$request->lon,
                'address'=>$request->direccion_sucursal,
                'telefono'=>$request->telefono_sucursal,
                'caracteristicas'=>preg_replace( "/\r|\n/", "",nl2br($request->caracteristicas)),
                'es_activo'=>1,
                'id_stand'=>$stand,
                'id_user'=>Auth::user()->id_empresa
            ]);
            return redirect()->back()->with('status', 'Se actualizaron los datos de la sucursal correctamente!');
        }
    }
    public function guardar_ejecutivos_stand(Request $request,$stand){
        if($request->id_ejecutivo=='N'){
            $id=DB::table('fv_ejecutivo')->insertGetId([
                'nombre'=>$request->nombre_ejecutivo,
                'cargo'=>preg_replace( "/\r|\n/", "",nl2br($request->cargo_ejecutivo)),
                'modo_contacto'=>$request->modo_contacto_ejecutivo,
                'link'=>$request->link_ejecutivo,
                'id_stand'=>$stand,
                'id_user'=>Auth::user()->id_empresa,
                'es_activo'=>1,
            ]);
            if($request->hasFile('foto_ejecutivo'))
                request()->foto_ejecutivo->move(dirname(base_path()).'/reactiva/public/img/ejecutivos',$id.".jpg");
            return redirect()->back()->with('status', 'Se registró el nuevo ejecutivo correctamente!');
        }
        else{
            DB::table('fv_ejecutivo')->where('id_ejecutivo',$request->id_ejecutivo)->update([
                'nombre'=>$request->nombre_ejecutivo,
                'cargo'=>preg_replace( "/\r|\n/", "",nl2br($request->cargo_ejecutivo)),
                'modo_contacto'=>$request->modo_contacto_ejecutivo,
                'link'=>$request->link_ejecutivo,
            ]);
            if($request->hasFile('foto_ejecutivo'))
            {
                if(file_exists(dirname(base_path()).'/reactiva/public/img/ejecutivos/'.$request->id_ejecutivo.".jpg"))
                    unlink(dirname(base_path()).'/reactiva/public/img/ejecutivos/'.$request->id_ejecutivo.".jpg");
                request()->foto_ejecutivo->move(dirname(base_path()).'/reactiva/public/img/ejecutivos',$request->id_ejecutivo.".jpg");
            }
            return redirect()->back()->with('status', 'Se actualizó los datos del ejecutivo correctamente!');
        }
    }
    public function guardar_ejecutivos(Request $request){
        if($request->caracteristicas_producto!='')
            $request->caracteristicas_producto=preg_replace( "/\r|\n/", "",nl2br($request->caracteristicas_producto));
        if($request->id_ejecutivo=='N'){
            $id=DB::table('fv_ejecutivo')->insertGetId([
                'nombre'=>$request->nombre_ejecutivo,
                'cargo'=>preg_replace( "/\r|\n/", "",nl2br($request->cargo_ejecutivo)),
                'modo_contacto'=>$request->modo_contacto_ejecutivo,
                'link'=>$request->link_ejecutivo,
                'id_user'=>Auth::user()->id_empresa,
                'es_activo'=>1,
            ]);
            if($request->hasFile('foto_ejecutivo'))
                request()->foto_ejecutivo->move(dirname(base_path()).'/reactiva/public/img/ejecutivos',$id.".jpg");
            return redirect()->back()->with('status', 'Se registró el nuevo ejecutivo correctamente!');
        }
        else{
            DB::table('fv_ejecutivo')->where('id_ejecutivo',$request->id_ejecutivo)->update([
                'nombre'=>$request->nombre_ejecutivo,
                'cargo'=>preg_replace( "/\r|\n/", "",nl2br($request->cargo_ejecutivo)),
                'modo_contacto'=>$request->modo_contacto_ejecutivo,
                'link'=>$request->link_ejecutivo,
            ]);
            if($request->hasFile('foto_ejecutivo'))
            {
                if(file_exists(dirname(base_path()).'/reactiva/public/img/ejecutivos/'.$request->id_ejecutivo.".jpg"))
                    unlink(dirname(base_path()).'/reactiva/public/img/ejecutivos/'.$request->id_ejecutivo.".jpg");
                request()->foto_ejecutivo->move(dirname(base_path()).'/reactiva/public/img/ejecutivos',$request->id_ejecutivo.".jpg");
            }
            return redirect()->back()->with('status', 'Se actualizó los datos del ejecutivo correctamente!');
        }
    }
    public function eliminar_ejecutivo($id){
        DB::table('fv_ejecutivo')->where('id_ejecutivo',$id)->update([
            'es_activo'=>0
        ]);
        return redirect()->back()->with('status', 'Se eliminó el ejecutivo correctamente!');
    }
    public function productos(){
        $link=DB::table('fv_solicitud')->where('id_empresa',Auth::user()->id_empresa)->where('codigo_fv',6)->first();
        $prod=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
        return view('plataforma.productos',['menu'=>true,'productos'=>$prod,'link'=>$link->meet_link]);
    }
    public function productos_stand($stand){
        $prod=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$stand)->where('es_activo',1)->get();
        $st=DB::table('fv_stand')->where('id_stand',$stand)->first();
        $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
        return view('plataforma.productos',['menu'=>true,'productos'=>$prod,'stands'=>$stands,'sel'=>$stand,'st'=>$st,'link'=>$st->meet_link]);
    }
    public function guardar_productos(Request $request){
        $tipo=DB::table('fv_solicitud')->where('id_empresa',Auth::user()->id_empresa)->where('codigo_fv',6)->select('tipo')->first();
        if($request->caracteristicas_producto!='')
            $request->caracteristicas_producto=preg_replace( "/\r|\n/", "",nl2br($request->caracteristicas_producto));
        if($request->id_producto=='N')
        {
            $id_prod=DB::table('fv_producto')->insertGetId([
                'nombre'=>$request->producto,
                'envasado'=>$request->envasado,
                'caracteristicas'=>$request->caracteristicas_producto,
                'fotos'=>'',
                'tags'=>'',
                'id_user'=>Auth::user()->id_empresa,
                'es_activo'=>1,
            ]);
            if(isset(request()->foto)){
                $foto_link="";
                foreach(request()->foto as $i=>$foto){
                    $foto->move(dirname(base_path()).'/fvirtual/public/img/productos',$id_prod."_".($i+1).".".$foto->getClientOriginalExtension());
                    $foto_link.=($i>0 ? ";" : "").$id_prod."_".($i+1).".".$foto->getClientOriginalExtension();
                }
            DB::table('fv_producto')->where('id_producto',$id_prod)->update(['fotos'=>$foto_link]);
            }
            if(isset(request()->adj_producto)){
                $adj_link="";
                foreach(request()->adj_producto as $i=>$adjunto){
                    $adjunto->move(public_path().'/pdf',$id_prod."_".$adjunto->getClientOriginalName());
                    $adj_link.=($i>0 ? ";" : "").$id_prod."_".$adjunto->getClientOriginalName();
                }
            DB::table('fv_producto')->where('id_producto',$id_prod)->update(['adj'=>$adj_link]);
            }
            return redirect()->back()->with('status', 'Se registró el nuevo producto correctamente!');
        }
        else{
            $fotos=explode(";",$request->fotos);
            $foto_link="";
            $adjs=explode(";",$request->adjs);
            $adj_link="";
            $cant=0;
            switch($tipo->tipo)
            {
                case 350:{$verifica=($request->check_foto_1 && $request->check_foto_2);}break;
                case 500:{$verifica=($request->check_foto_1 && $request->check_foto_2 && $request->check_foto_3);}break;
                case 700:{$verifica=($request->check_foto_1 && $request->check_foto_2 && $request->check_foto_3 && $request->check_foto_4 && $request->check_foto_5);}break;
            }
            if($verifica)
                $foto_link=$request->fotos;
            else{
                if($request->check_foto_1 && $fotos[0]!='')
                    {
                    $foto_link.=$fotos[0];
                    $cant=1;
                    }
                else
                    {
                    if($fotos[0]!='')
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[0]);
                    }
                if($request->check_foto_2)
                    {
                    if($cant==1)
                        {
                        $foto_link.=";".$fotos[1];
                        $cant++;    
                        }
                    else
                        {
                        $ext=explode(".",$fotos[1]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[1],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_1.".$ext[1]);
                        $foto_link.=$request->id_producto."_1.".$ext[1];
                        $cant++;    
                        }
                    }
                else
                    {
                    if(isset($fotos[1]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[1]);
                    }
                if($request->check_foto_3)
                    {
                    if($cant==2)
                        {
                        $foto_link.=";".$fotos[2];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[2]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[2],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[2]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[2]);
                    }
                if($request->check_foto_4)
                    {
                    if($cant==3)
                        {
                        $foto_link.=";".$fotos[3];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[3]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[3]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3]);
                    }
                if($request->check_foto_5)
                    {
                    if($cant==4)
                        {
                        $foto_link.=";".$fotos[4];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[4]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[4],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[4]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[4]);
                    }
                if(isset(request()->foto)){
                    foreach(request()->foto as $i=>$foto){
                        $foto->move(dirname(base_path()).'/fvirtual/public/img/productos',$request->id_producto."_".($cant+$i+1).".".$foto->getClientOriginalExtension());
                        $foto_link.=($foto_link!='' ? ";" : "").$request->id_producto."_".($i+$cant+1).".".$foto->getClientOriginalExtension();
                    }
                }
            }
            foreach($adjs as $ij=>$ad){
                if(isset($request->check_prod[$ij])){
                    $adj_link.=($adj_link == '' ? '' : ';').$ad;
                }
                else{
                    if(file_exists(public_path().'/pdf/'.$adjs[$ij]) && ($adjs[$ij]!=''))
                        unlink(public_path().'/pdf/'.$adjs[$ij]);
                }
            }
            if(isset(request()->adj_producto)){
                foreach(request()->adj_producto as $i=>$adjunto){
                    $adjunto->move(public_path().'/pdf',$request->id_producto."_".$adjunto->getClientOriginalName());
                    $adj_link.=($adj_link!='' ? ";" : "").$request->id_producto."_".$adjunto->getClientOriginalName();
                }
            }
            DB::table('fv_producto')->where('id_producto',$request->id_producto)->update([
                'nombre'=>$request->producto,
                'envasado'=>$request->envasado,
                'caracteristicas'=>$request->caracteristicas_producto,
                'fotos'=>$foto_link,
                'adj'=>$adj_link,
                'es_activo'=>1
            ]);
            return redirect()->back()->with('status', 'Se actualizó el producto correctamente!');
        }
    }
    public function guardar_productos_stand($stand,Request $request){
        $tipo=DB::table('fv_solicitud')->where('id_empresa',Auth::user()->id_empresa)->where('codigo_fv',6)->select('tipo')->first();
        if($request->caracteristicas_producto!='')
            $request->caracteristicas_producto=preg_replace( "/\r|\n/", "",nl2br($request->caracteristicas_producto));
        if($request->id_producto=='N')
        {
            $id_prod=DB::table('fv_producto')->insertGetId([
                'nombre'=>$request->producto,
                'envasado'=>$request->envasado,
                'caracteristicas'=>$request->caracteristicas_producto,
                'fotos'=>'',
                'tags'=>'',
                'id_user'=>Auth::user()->id_empresa,
                'id_stand'=>$stand,
                'es_activo'=>1,
            ]);
            if(isset(request()->foto)){
                $foto_link="";
                foreach(request()->foto as $i=>$foto){
                    $foto->move(dirname(base_path()).'/fvirtual/public/img/productos',$id_prod."_".($i+1).".".$foto->getClientOriginalExtension());
                    $foto_link.=($foto_link!="" ? ";" : "").$id_prod."_".($i+1).".".$foto->getClientOriginalExtension();
                }
            DB::table('fv_producto')->where('id_producto',$id_prod)->update(['fotos'=>$foto_link]);
            }
            if(isset(request()->adj_producto)){
                $adj_link="";
                foreach(request()->adj_producto as $i=>$adjunto){
                    $adjunto->move(public_path().'/pdf',$id_prod."_".$adjunto->getClientOriginalName());
                    $adj_link.=($i>0 ? ";" : "").$id_prod."_".$adjunto->getClientOriginalName();
                }
            DB::table('fv_producto')->where('id_producto',$id_prod)->update(['adj'=>$adj_link]);
            }
            return redirect()->back()->with('status', 'Se registró el nuevo producto correctamente!');
        }
        else{
            $fotos=explode(";",$request->fotos);
            $foto_link="";
            $adjs=explode(";",$request->adjs);
            $adj_link="";
            $cant=0;
            switch($tipo->tipo)
            {
                case 350:{$verifica=($request->check_foto_1 && $request->check_foto_2);}break;
                case 500:{$verifica=($request->check_foto_1 && $request->check_foto_2 && $request->check_foto_3);}break;
                case 700:{$verifica=($request->check_foto_1 && $request->check_foto_2 && $request->check_foto_3 && $request->check_foto_4 && $request->check_foto_5);}break;
            }
            if($verifica)
                $foto_link=$request->fotos;
            else{
                if($request->check_foto_1 && $fotos[0]!='')
                    {
                    $foto_link.=$fotos[0];
                    $cant=1;
                    }
                else
                    {
                    if($fotos[0]!='')
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[0]);
                    }
                if($request->check_foto_2)
                    {
                    if($cant==1)
                        {
                        $foto_link.=";".$fotos[1];
                        $cant++;    
                        }
                    else
                        {
                        $ext=explode(".",$fotos[1]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[1],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_1.".$ext[1]);
                        $foto_link.=$request->id_producto."_1.".$ext[1];
                        $cant++;    
                        }
                    }
                else
                    {
                    if(isset($fotos[1]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[1]);
                    }
                if($request->check_foto_3)
                    {
                    if($cant==2)
                        {
                        $foto_link.=";".$fotos[2];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[2]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[2],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[2]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[2]);
                    }
                if($request->check_foto_4)
                    {
                    if($cant==3)
                        {
                        $foto_link.=";".$fotos[3];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[3]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[3]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3]);
                    }
                if($request->check_foto_4)
                    {
                    if($cant==3)
                        {
                        $foto_link.=";".$fotos[3];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[3]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[3]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[3]);
                    }
                if($request->check_foto_5)
                    {
                    if($cant==4)
                        {
                        $foto_link.=";".$fotos[4];
                        $cant++;
                        }
                    else
                        {
                        $ext=explode(".",$fotos[4]);
                        rename(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[4],dirname(base_path()).'/fvirtual/public/img/productos/'.$request->id_producto."_".($cant+1).".".$ext[1]);
                        $foto_link.=$request->id_producto."_".($cant+1).".".$ext[1];
                        $cant++;
                        }
                    }
                else
                    {
                    if(isset($fotos[4]))
                        unlink(dirname(base_path()).'/fvirtual/public/img/productos/'.$fotos[4]);
                    }
                if(isset(request()->foto)){
                    foreach(request()->foto as $i=>$foto){
                        $foto->move(dirname(base_path()).'/fvirtual/public/img/productos',$request->id_producto."_".($cant+$i+1).".".$foto->getClientOriginalExtension());
                        $foto_link.=($foto_link!='' ? ";" : "").$request->id_producto."_".($i+$cant+1).".".$foto->getClientOriginalExtension();
                    }
                }
            }
            foreach($adjs as $ij=>$ad){
                if(isset($request->check_prod[$ij])){
                    $adj_link.=($adj_link == '' ? '' : ';').$ad;
                }
                else{
                    if(file_exists(public_path().'/pdf/'.$adjs[$ij]) && ($adjs[$ij]!=''))
                        unlink(public_path().'/pdf/'.$adjs[$ij]);
                }
            }
            if(isset(request()->adj_producto)){
                foreach(request()->adj_producto as $i=>$adjunto){
                    $adjunto->move(public_path().'/pdf',$request->id_producto."_".$adjunto->getClientOriginalName());
                    $adj_link.=($adj_link!='' ? ";" : "").$request->id_producto."_".$adjunto->getClientOriginalName();
                }
            }
            DB::table('fv_producto')->where('id_producto',$request->id_producto)->update([
                'nombre'=>$request->producto,
                'envasado'=>$request->envasado,
                'caracteristicas'=>$request->caracteristicas_producto,
                'fotos'=>$foto_link,
                'id_stand'=>$stand,
                'adj'=>$adj_link,
                'es_activo'=>1
            ]);
            return redirect()->back()->with('status', 'Se actualizó el producto correctamente!');
        }
    }
    public function eliminar_productos($id){
        DB::table('fv_producto')->where('id_producto',$id)->update(['es_activo'=>0]);
        return redirect()->back()->with('status', 'Se eliminó el producto correctamente!');
    }
    public function ofertas(){
        $link=DB::table('fv_solicitud')->where('id_empresa',Auth::user()->id_empresa)->where('codigo_fv',6)->first();
        $ofertas=DB::table('fv_oferta')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
        $productos=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->get();
        return view('plataforma.ofertas',['menu'=>true,'ofertas'=>$ofertas,'productos'=>$productos,'link'=>$link->meet_link]);
    }
    public function ofertas_stand($stand){
        $ofertas=DB::table('fv_oferta')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$stand)->where('es_activo',1)->get();
        $st=DB::table('fv_stand')->where('id_stand',$stand)->first();
        $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
        $productos=DB::table('fv_producto')->where('id_user',Auth::user()->id_empresa)->where('id_stand',$stand)->where('es_activo',1)->get();
        return view('plataforma.ofertas',['menu'=>true,'ofertas'=>$ofertas,'productos'=>$productos,'stands'=>$stands,'sel'=>$stand,'st'=>$st,'link'=>$st->meet_link]);
    }
    public function guardar_ofertas(Request $request){
        if($request->id_oferta=='N'){
            DB::table('fv_oferta')->insert([
                'nombre_oferta'=>$request->nombre_oferta,
                'detalle_oferta'=>preg_replace( "/\r|\n/", "",nl2br($request->detalle_oferta)),
                'productos'=>implode(';',$request->productos),
                'es_activo'=>1,
                'id_user'=>Auth::user()->id_empresa,
            ]);
            return redirect()->back()->with('status', 'Se guardó la nueva oferta correctamente!');
        }
        else{
            DB::table('fv_oferta')->where('id_oferta',$request->id_oferta)->update([
                'nombre_oferta'=>$request->nombre_oferta,
                'detalle_oferta'=>preg_replace( "/\r|\n/", "",nl2br($request->detalle_oferta)),
                'productos'=>implode(';',$request->productos),
                'es_activo'=>1,
            ]);
            return redirect()->back()->with('status', 'Se actualizó la oferta correctamente!');
        }
    }
    public function guardar_ofertas_stand($stand,Request $request){
        if($request->id_oferta=='N'){
            DB::table('fv_oferta')->insert([
                'nombre_oferta'=>$request->nombre_oferta,
                'detalle_oferta'=>preg_replace( "/\r|\n/", "",nl2br($request->detalle_oferta)),
                'productos'=>implode(';',$request->productos),
                'es_activo'=>1,
                'id_user'=>Auth::user()->id_empresa,
                'id_stand'=>$stand,
            ]);
            return redirect()->back()->with('status', 'Se guardó la nueva oferta correctamente!');
        }
        else{
            DB::table('fv_oferta')->where('id_oferta',$request->id_oferta)->update([
                'nombre_oferta'=>$request->nombre_oferta,
                'detalle_oferta'=>preg_replace( "/\r|\n/", "",nl2br($request->detalle_oferta)),
                'productos'=>implode(';',$request->productos),
                'es_activo'=>1,
            ]);
            return redirect()->back()->with('status', 'Se actualizó la oferta correctamente!');
        }
    }
    public function eliminar_sucursal($id){
        DB::table('fv_sucursal')->where('id_sucursal',$id)->update(['es_activo'=>0]);
        return redirect()->back()->with('status', 'Se eliminó la sucursal correctamente!');
    }
    public function eliminar_ofertas($id){
        DB::table('fv_oferta')->where('id_oferta',$id)->update(['es_activo'=>0]);
        return redirect()->back()->with('status', 'Se eliminó la oferta correctamente!');
    }
    public function visita(){
        if(Cookie::has('user_id'))
        {
            $vivo=false;
            $videoAnt=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio<=DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->whereRaw('TIMESTAMPDIFF(MINUTE,fecha_inicio,NOW()) BETWEEN -5 AND duracion')->orderBy('fecha_inicio','DESC')->first();
            if(isset($videoAnt->link))
                $vivo=true;
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>0,'fecha'=>date('Y-m-d H:i:s')]);
            //nuevo ingreso de visitante repitente
            return view('visita.mapa',['vivo'=>$vivo]);
        }
        else{
            return view('visita.index');
            }
    }
    public function mapa(Request $request){
        $vivo=false;
        $videoAnt=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio<=DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->whereRaw('TIMESTAMPDIFF(MINUTE,fecha_inicio,NOW()) BETWEEN -5 AND duracion')->orderBy('fecha_inicio','DESC')->first();
        if(isset($videoAnt->link))
            $vivo=true;
        if(Cookie::has('user_id')){
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>0,'fecha'=>date('Y-m-d H:i:s')]);
            return view('visita.mapa',['vivo'=>$vivo]);
        }
        else{
            $id=DB::table('fv_ticket')->insertGetId([
                'edad'=>$request->edad,
                'genero'=>$request->genero,
                'nombre'=>$request->nombre,
                'email'=>$request->email,
                'ip'=>request()->ip(),
                'fecha_visita'=>date('Y-m-d H:i:s')
            ]);
            Cookie::queue('user_id', $id, (5 * 24 * 60));
            DB::table('fv_visitas')->insert(['id_user'=>$id,'stand'=>0,'fecha'=>date('Y-m-d H:i:s')]);
            return view('visita.mapa',['vivo'=>$vivo]);
        }
    }
    public function auditorio(){
        if(Cookie::has('user_id')){
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>1,'fecha'=>date('Y-m-d H:i:s')]);
//            $videoAnt=DB::table('fv_video')->where('codigo_fv',3)->whereRaw('fecha_inicio BETWEEN DATE_ADD(NOW(), INTERVAL -1 HOUR) AND NOW()')->orderBy('fecha_inicio','DESC')->first();
            $videoAnt=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio<=DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->orderBy('fecha_inicio','DESC')->first();
            $videos=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio>DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->orderBy('fecha_inicio','ASC')->first();
            $eventos=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio<=DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->orderBy('fecha_inicio','DESC')->get();
            return view('visita.auditorio',['videos'=>$videos,'vant'=>$videoAnt,'eventos'=>$eventos]);
        }
        else{
            return redirect('visita');
        }
    }
    public function teatro($id){
        if(Cookie::has('user_id')){
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>1,'fecha'=>date('Y-m-d H:i:s')]);
//            $videoAnt=DB::table('fv_video')->where('codigo_fv',3)->whereRaw('fecha_inicio BETWEEN DATE_ADD(NOW(), INTERVAL -1 HOUR) AND NOW()')->orderBy('fecha_inicio','DESC')->first();
            $videoAnt=DB::table('fv_video')->where('link',$id)->first();
            $videos=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio>DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->orderBy('fecha_inicio','ASC')->first();
            $eventos=DB::table('fv_video')->where('codigo_fv',6)->whereRaw('fecha_inicio<=DATE_ADD(NOW(), INTERVAL 5 MINUTE)')->orderBy('fecha_inicio','DESC')->get();
            return view('visita.auditorio',['videos'=>$videos,'vant'=>$videoAnt,'eventos'=>$eventos,'no_actualizar'=>true]);
        }
        else{
            return redirect('visita');
        }
    }
    public function previa_stand() {
        $d=DB::table('fv_solicitud as f')->join('empresas as e','f.id_empresa','=','e.id_empresa')->where('f.codigo_fv',6)->where('f.id_empresa',Auth::user()->id_empresa)->select('f.*','e.*')->first();
        $d->logo=Auth::user()->id_empresa;
        $ejecutivos=DB::table('fv_ejecutivo')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
        $productos=DB::table('fv_producto')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
        $sucs=DB::table('fv_sucursal')->where('id_user',$d->id_empresa)->where('es_activo',1)->get();
        $ofertas=DB::table('fv_oferta')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
        foreach($productos as $i=>$p){
  //          $productos[$i]->setAttribute('ofert',[]);
            if(strpos($p->caracteristicas,'https')!==false)
                {
                    $subst=substr($p->caracteristicas,strpos($p->caracteristicas,'https'));
                    $subss=explode(' ',$subst);
                    $can=strlen($subss[0]);
                    $p->caracteristicas=substr_replace($p->caracteristicas,'</a>',strpos($p->caracteristicas,'https')+$can,0);
                    $productos[$i]->caracteristicas=substr_replace($p->caracteristicas,'<a href="'.$subss[0].'">',strpos($p->caracteristicas,'https'),0);
                }
            $j=0;
            foreach($ofertas as $o){
                $off=explode(";",$o->productos);
                if(array_search($p->id_producto,$off)!==false)
                {
                    $productos[$i]->ofert[$j]=$o;
    //                dd($productos[$i]->ofert);
                    //array_push($productos[$i]->ofert,$o);
                    $j++;
                }
            }
//            dd($productos[$i]);
        }
        if($d->video!=''){
        $texto=$d->video;
        if (strpos($texto, 'youtu.be') !== false) {
            $aux=explode("/",$texto);
            $d->video="https://www.youtube.com/embed/".end($aux);
        }
        elseif (strpos($texto, 'youtube.com') !== false) {
            if(strpos($texto, 'embed') !== false)
                $d->video=$texto;
            else
            {
                $ini = strpos($texto, "v=");
                $ini+=strlen("v=");
                if(strpos($texto,"&",$ini)!==false)
                    {
                    $len=strpos($texto,"&",$ini)-$ini;
                    $aux=substr($texto,$ini,$len);
                    }
                else
                    $aux=substr($texto,$ini);                
                $d->video="https://www.youtube.com/embed/".$aux;
            }
        }
        elseif (strpos($texto, 'facebook.com') !== false) {
            if((strpos($texto, 'videos/') !== false))
                $buscador="videos/";
            else
                $buscador="watch/?v=";
            $ini = strpos($texto, $buscador);
            $ini+=strlen($buscador);
            if(strpos($texto,"/",$ini)!==false)
                {
                $len=strpos($texto,"/",$ini)-$ini;
                $aux=substr($texto,$ini,$len);
                }
            else
                $aux=substr($texto,$ini);
            $d->video="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
        }
        elseif (strpos($texto, 'vimeo.com') !== false) {
            $aux=explode("/",$texto);
            $d->video="https://player.vimeo.com/video/".end($aux);
        }
        }
        if($d->video2!=''){
            $texto=$d->video2;
            if (strpos($texto, 'youtu.be') !== false) {
                $aux=explode("/",$texto);
                $d->video2="https://www.youtube.com/embed/".end($aux);
            }
            elseif (strpos($texto, 'youtube.com') !== false) {
                if(strpos($texto, 'embed') !== false)
                    $d->video2=$texto;
                else
                {
                    $ini = strpos($texto, "v=");
                    $ini+=strlen("v=");
                    if(strpos($texto,"&",$ini)!==false)
                        {
                        $len=strpos($texto,"&",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);                
                    $d->video2="https://www.youtube.com/embed/".$aux;
                }
            }
            elseif (strpos($texto, 'facebook.com') !== false) {
                if((strpos($texto, 'videos/') !== false))
                    $buscador="videos/";
                else
                    $buscador="watch/?v=";
                $ini = strpos($texto, $buscador);
                $ini+=strlen($buscador);
                if(strpos($texto,"/",$ini)!==false)
                    {
                    $len=strpos($texto,"/",$ini)-$ini;
                    $aux=substr($texto,$ini,$len);
                    }
                else
                    $aux=substr($texto,$ini);
                $d->video2="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
            }
            elseif (strpos($texto, 'vimeo.com') !== false) {
                $aux=explode("/",$texto);
                $d->video2="https://player.vimeo.com/video/".end($aux);
            }
            }
        return view('plataforma.stand',['st'=>$d,'productos'=>$productos,'sucs'=>$sucs,'link'=>$d->meet_link,'ejecutivos'=>$ejecutivos]);
    }
    public function previa_stand_1($stand){
            $d=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->where('id_stand',$stand)->select('*')->first();
            $d->logo=Auth::user()->id_empresa."_".$stand;
            $d->nombre_empresa=$d->nombre;
            $d->email_representante=$d->email;
            $d->telefono_responsable=$d->telefono;
            $ejecutivos=DB::table('fv_ejecutivo')->where('id_stand',$stand)->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->select('*')->get();
            $productos=DB::table('fv_producto')->where('id_stand',$stand)->where('es_activo',1)->where('id_user',Auth::user()->id_empresa)->select('*')->get();
            $sucs=DB::table('fv_sucursal')->where('id_stand',$stand)->where('es_activo',1)->where('id_user',Auth::user()->id_empresa)->get();
            $ofertas=DB::table('fv_oferta')->where('id_stand',$stand)->where('es_activo',1)->where('id_user',Auth::user()->id_empresa)->where('es_activo',1)->select('*')->get();
            foreach($productos as $i=>$p){
                //          $productos[$i]->setAttribute('ofert',[]);
                if(strpos($p->caracteristicas,'https')!==false)
                    {
                        $subst=substr($p->caracteristicas,strpos($p->caracteristicas,'https'));
                        $subss=explode(' ',$subst);
                        $can=strlen($subss[0]);
                        $p->caracteristicas=substr_replace($p->caracteristicas,'</a>',strpos($p->caracteristicas,'https')+$can,0);
                        $productos[$i]->caracteristicas=substr_replace($p->caracteristicas,'<a href="'.$subss[0].'">',strpos($p->caracteristicas,'https'),0);
                    }
                $j=0;
                foreach($ofertas as $o){
                    $off=explode(";",$o->productos);
                    if(array_search($p->id_producto,$off)!==false)
                    {
                        $productos[$i]->ofert[$j]=$o;
        //                dd($productos[$i]->ofert);
                        //array_push($productos[$i]->ofert,$o);
                        $j++;
                    }
                }
    //            dd($productos[$i]);
            }
            if($d->video!=''){
            $texto=$d->video;
            if (strpos($texto, 'youtu.be') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://www.youtube.com/embed/".end($aux);
            }
            elseif (strpos($texto, 'youtube.com') !== false) {
                if(strpos($texto, 'embed') !== false)
                    $d->video=$texto;
                else
                {
                    $ini = strpos($texto, "v=");
                    $ini+=strlen("v=");
                    if(strpos($texto,"&",$ini)!==false)
                        {
                        $len=strpos($texto,"&",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);                
                    $d->video="https://www.youtube.com/embed/".$aux;
                }
            }
            elseif (strpos($texto, 'facebook.com') !== false) {
                if((strpos($texto, 'videos/') !== false))
                    $buscador="videos/";
                else
                    $buscador="watch/?v=";
                $ini = strpos($texto, $buscador);
                $ini+=strlen($buscador);
                if(strpos($texto,"/",$ini)!==false)
                    {
                    $len=strpos($texto,"/",$ini)-$ini;
                    $aux=substr($texto,$ini,$len);
                    }
                else
                    $aux=substr($texto,$ini);
                $d->video="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
            }
            elseif (strpos($texto, 'vimeo.com') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://player.vimeo.com/video/".end($aux);
            }    
            }
            if($d->video2!=''){
                $texto=$d->video2;
                if (strpos($texto, 'youtu.be') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://www.youtube.com/embed/".end($aux);
                }
                elseif (strpos($texto, 'youtube.com') !== false) {
                    if(strpos($texto, 'embed') !== false)
                        $d->video2=$texto;
                    else
                    {
                        $ini = strpos($texto, "v=");
                        $ini+=strlen("v=");
                        if(strpos($texto,"&",$ini)!==false)
                            {
                            $len=strpos($texto,"&",$ini)-$ini;
                            $aux=substr($texto,$ini,$len);
                            }
                        else
                            $aux=substr($texto,$ini);                
                        $d->video2="https://www.youtube.com/embed/".$aux;
                    }
                }
                elseif (strpos($texto, 'facebook.com') !== false) {
                    if((strpos($texto, 'videos/') !== false))
                        $buscador="videos/";
                    else
                        $buscador="watch/?v=";
                    $ini = strpos($texto, $buscador);
                    $ini+=strlen($buscador);
                    if(strpos($texto,"/",$ini)!==false)
                        {
                        $len=strpos($texto,"/",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);
                    $d->video2="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
                }
                elseif (strpos($texto, 'vimeo.com') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://player.vimeo.com/video/".end($aux);
                }
                }
            $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',Auth::user()->id_empresa)->get();
            return view('plataforma.stand1',['st'=>$d,'productos'=>$productos,'sucs'=>$sucs,'stands'=>$stands,'sel'=>$stand,'link'=>$d->meet_link,'ejecutivos'=>$ejecutivos]);
    }
    public function pabellon($pabellon){
        if(Cookie::has('user_id')){
            $ofertas=array();
            $oferta=new \stdClass();
            $p=DB::table('fv_rubro')->where('id_rubro',$pabellon)->where('codigo_fv',6)->first();
            if(!isset($p))
                return redirect('visita');
            else
                $st=DB::table('fv_solicitud as f')->join('empresas as e','e.id_empresa','=','f.id_empresa')->where(function($q) use ($pabellon) {$q->where('f.pabellon',$pabellon)->orWhere('f.stands','>',1);})->where('f.codigo_fv',6)->where('f.estado_pago',1)->orderBy('f.fecha_solicitud','ASC')->orderBy('f.tipo','DESC')->select('f.id_solicitud','f.id_empresa','e.nombre_empresa','f.stands','f.descripcion','f.nombre_stand')->get();
            foreach($st as $i=>$s)
                {
                    if($s->stands==1)
                    {
                        $off=DB::table('fv_oferta')->where('es_activo',1)->where('id_user',$s->id_empresa)->get();
                        foreach($off as $k=>$o)
                        {
                            $productos_lista='';
                            $prods=explode(';',$o->productos);
                            foreach($prods as $pr)
                            {
                                $prods=DB::table('fv_producto')->where('id_producto',$pr)->select('nombre')->first();
                                $productos_lista.=($productos_lista=='' ? '' : ', ').$prods->nombre;
                            }
                            $oferta->nombre=$o->nombre_oferta;
                            $oferta->detalle=$o->detalle_oferta;
                            $oferta->producto=$productos_lista;
                            $oferta->id_stand=$s->id_empresa;
                            array_push($ofertas,$oferta);
                            unset($oferta);
                            $oferta=new \stdClass();
                        }
                    }
                if(!is_null($s->nombre_stand))
                    $st[$i]->nombre_empresa=$s->nombre_stand;
                if($s->stands>1)
                    {
                    $sts=DB::table('fv_stand')->where('id_user',$s->id_empresa)->where('cod_fv',6)->where('pabellon',$pabellon)->select('id_stand','id_user','nombre','descripcion')->get();
                    $st[$i]->detalle_stands=$sts;
                    foreach($sts as $sts1)
                        {
                            $off=DB::table('fv_oferta')->where('es_activo',1)->where('id_user',$s->id_empresa)->where('id_stand',$sts1->id_stand)->get();
                            foreach($off as $k=>$o)
                            {
                                $productos_lista='';
                                $prods=explode(';',$o->productos);
                                foreach($prods as $pr)
                                {
                                    $prods=DB::table('fv_producto')->where('id_producto',$pr)->select('nombre')->first();
                                    $productos_lista.=($productos_lista=='' ? '' : ', ').$prods->nombre;
                                }
                                $oferta->nombre=$o->nombre_oferta;
                                $oferta->detalle=$o->detalle_oferta;
                                $oferta->producto=$productos_lista;
                                $oferta->id_stand=$s->id_empresa."_".$sts1->id_stand;
                                array_push($ofertas,$oferta);
                                unset($oferta);
                                $oferta=new \stdClass();
                            }                                        
                        }
                    }
                }
            $poly=
                array(
                    array(
                        "167,1669,621,1669,689,1467,689,1286,301,1286,182,1338",
                        "971,1670,1425,1670,1413,1339,1384,1284,994,1284,975,1340",
                        "2288,1670,2259,1339,2128,1284,1737,1284,1737,1440,1836,1670",
                        "422,1264,761,1263,797,1149,798,1013,497,1012,430,1023",
                        "1017,1263,1356,1266,1350,1020,1326,1012,1031,1012,1017,1024",
                        "1661,1267,2000,1267,1981,1026,1905,1011,1605,1013,1602,1132",
                        "585,988,883,988,904,910,892,797,847,793,694,816,652,833,632,911",
                        "1054,990,1354,990,1332,812,1129,818,1066,914",
                        "1537,990,1827,990,1817,835,1773,793,1727,794,1566,818,1505,913",
                        "681,809,902,809,921,756,914,681,896,670,700,653",
                        "1073,810,1279,808,1284,653,1087,653,1077,755",
                        "1451,808,1670,809,1659,654,1463,654,1446,691,1431,756",
                        "781,655,949,671,965,635,960,570,946,545,787,545",
                        "1095,654,1266,654,1263,543,1104,546",
                        "1568,653,1566,545,1406,545,1396,581,1383,634,1398,670"
                    ),
                    array(
                        "265,1625,715,1625,767,1463,749,1277,289,1277",
                        "1027,1621,1483,1621,1469,1279,1051,1279",
                        "1793,1621,2243,1621,2225,1279,1807,1277,1769,1305,1733,1463",
                        "509,1213,845,1213,879,1121,867,975,839,957,530,957",
                        "1085,1213,1425,1213,1415,955,1103,955",
                        "1645,1213,1981,1213,1969,957,1663,957,1637,995,1611,1121",
                        "663,957,929,957,949,897,937,781,921,757,681,757",
                        "1109,955,1371,955,1365,755,1121,755",
                        "1549,955,1811,955,1801,755,1559,755,1545,797,1525,897"
                    ),
                    array(
                        "389,1299,713,1299,759,1163,757,1017,479,1011,395,1031",
                        "809,1298,1131,1298,1136,1017,848,1014,813,1029",
                        "1252,1296,1572,1296,1550,1029,1520,1012,1242,1012",
                        "1688,1298,2006,1298,1981,1028,1909,1012,1628,1012,1629,1152",
                        "559,1011,809,1016,841,932,843,812,565,807",
                        "892,1012,1147,1014,1147,809,894,809",
                        "1238,1012,1494,1012,1488,884,1477,807,1236,807",
                        "1583,1017,1837,1012,1818,806,1548,808,1545,920",
                        "726,784,894,790,917,737,912,627,699,630,699,712",
                        "994,782,1163,787,1163,632,966,632,966,712",
                        "1271,782,1446,787,1441,630,1245,630,1245,712",
                        "1546,786,1721,789,1720,629,1518,630,1522,736",
                        "947,1681,1385,1681,1349,1299,1003,1309,969,1359"
                    ),
                    array(
                        "969,1689,1409,1689,1389,1227,973,1227",
                        "475,1379,819,1377,853,1271,851,1211,821,1005,479,1005",
                        "1617,1379,1975,1379,1951,1003,1607,1003,1571,1121,1571,1249",
                        "1027,1195,1385,1195,1403,1049,1403,865,1041,865"
                    ),
                    array(
                        "1005,1657,1475,1657,1465,1197,1011,1197",
                        "359,1329,723,1329,763,1217,763,1047,719,973,361,973",
                        "1727,1327,2095,1327,2077,973,1721,973,1669,1047,1669,1211",
                        "821,1115,1123,1113,1117,823,825,821",
                        "1281,1113,1583,1117,1571,823,1281,823,1275,903"
                    ),
                    array(
                        "29,1355,677,1355,807,1033,783,787,667,787,667,747,93,741",
                        "861,1353,1505,1353,1481,741,913,741",
                        "1700,1353,2341,1353,2295,743,1725,739,1605,829,1559,1031",
                        "591,739,665,739,665,787,905,787,949,679,937,531,895,531,897,461,587,461",
                        "1019,739,1345,739,1345,463,1031,463",
                        "1445,741,1479,741,1479,789,1727,787,1725,743,1787,743,1785,463,1477,463,1481,553,1435,553,1411,681",
                        "1003,547,1023,503,1015,393,999,343,803,339,797,435,797,463,897,461",
                        "1083,341,1281,341,1281,459,1083,461",
                        "1357,545,1477,545,1477,463,1565,463,1565,341,1369,341"
                    ),
                    array(
                        "393,628,673,629,668,472,422,472",
                        "67,454,266,455,270,368,181,348,72,348",
                        "316,457,425,455,428,417,517,416,521,327,358,326,323,347",
                        "580,416,655,418,657,453,782,456,776,348,745,325,582,326",
                        "850,461,1050,461,1043,351,968,328,802,328,798,389",
                        "228,319,363,318,383,288,380,245,268,243,229,248",
                        "400,317,535,318,535,244,403,244",
                        "576,316,710,316,709,246,578,240",
                        "750,317,883,317,881,243,731,244,730,286",
                        "330,232,418,232,431,218,428,185,331,182",
                        "449,233,542,233,541,185,451,183",
                        "569,229,661,229,658,182,570,186",
                        "691,233,785,231,786,180,681,185,681,216",
                        "393,628,673,629,668,472,422,472",
                        "67,454,266,455,270,368,181,348,72,348",
                        "316,457,425,455,428,417,517,416,521,327,358,326,323,347",
                        "580,416,655,418,657,453,782,456,776,348,745,325,582,326",
                        "850,461,1050,461,1043,351,968,328,802,328,798,389",
                        "228,319,363,318,383,288,380,245,268,243,229,248",
                        "400,317,535,318,535,244,403,244",
                        "576,316,710,316,709,246,578,240",
                        "750,317,883,317,881,243,731,244,730,286",
                        "330,232,418,232,431,218,428,185,331,182",
                        "449,233,542,233,541,185,451,183",
                        "569,229,661,229,658,182,570,186",
                        "691,233,785,231,786,180,681,185,681,216"
                    )
                );
            $x=
                array(
                    array(
                        "185","976","1822","430","1020","1655","653","1121","1594","700","1086","1461","787","1104","1406"
                    ),
                    array(
                        "287","1049","1807","529","1101","1659","683","1119","1559"
                    ),
                    array(
                        "397","814","1249","1680","565","896","1240","1581","698","966","1246","1519","969"
                    ),
                    array(
                        "973","479","1611","1041"
                    ),
                    array(
                        "1013","361","1725","825","1281"
                    ),
                    array(
                        "95","911","1727","588","1032","1477","801","1085","1368"
                    ),
                    array(
                        "512","73","325","668","929","229","403","633","806","331","451","610","728","512","73","325","668","929","229","403","633","806","331","451","610","728"
                    )
                );
            $y=
                array(
                    array(
                        "1339","1340","1340","1024","1025","1024","833","837","835","654","654","654","545","545","545"
                    ),
                    array(
                        "1279","1277","1277","955","955","955","757","757","757"
                    ),
                    array(
                        "1029","1029","1027","1028","807","807","807","807","630","630","630","630","1356"
                    ),
                    array(
                        "1225","1003","1003","865"
                    ),
                    array(
                        "1197","975","975","823","823"
                    ),
                    array(
                        "741","741","741","462","462","462","340","341","341"
                    ),
                    array(
                        "473","347","350","349","351","248","246","247","245","181","183","181","180","473","347","350","349","351","248","246","247","245","181","183","181","180"
                    )
                );
            $giro=
                array(
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    ),
                    array(
                        "0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"
                    )
                );
            $width=
                array(
                    array(
                        "437","437","437","329","329","327","221","221","221","197","197","197","161","161","161"
                    ),
                    array(
                        "419","421","419","313","313","313","241","247","247"
                    ),
                    array(
                        "303","302","304","303","239","239","238","238","199","199","199","199","400"
                    ),
                    array(
                        "413","339","341","361"
                    ),
                    array(
                        "451","357","353","293","293"
                    ),
                    array(
                        "567","567","567","308","309","309","197","197","197"
                    ),
                    array(
                        "156","109","109","109","109","78","74","76","74","50","52","50","56","156","109","109","109","109","78","74","76","74","50","52","50","56"
                    )
                );
            $height=
                array(
                    array(
                        "117","117","117","88","88","88","61","61","61","63","63","63","53","53","53"
                    ),
                    array(
                        "135","137","139","107","107","107","79","79","79"
                    ),
                    array(
                        "98","97","99","99","77","76","76","76","82","82","82","82","133"
                    ),
                    array(
                        "261","207","209","183"
                    ),
                    array(
                        "213","161","159","135","135"
                    ),
                    array(
                        "253","249","251","135","135","135","86","86","86"
                    ),
                    array(
                        "142","100","100","100","100","68","68","68","68","48","48","48","48","142","100","100","100","100","68","68","68","68","48","48","48","48"
                    )
                );
            if(isset($p))
                return view('visita.pabellon',['p'=>$p,'vivo'=>false,'stands'=>$st,'x'=>$x[$pabellon-47],'y'=>$y[$pabellon-47],'poly'=>$poly[$pabellon-47],'wi'=>$width[($pabellon-47)],'he'=>$height[($pabellon-47)],'ofertas'=>$ofertas,'giro'=>$giro[($pabellon-47)]]);
            else 
                return redirect('visita');
            }
        else{
            return redirect('visita');
        }
    }
    public function visita_stand($stand){
        if(Cookie::has('user_id')){
            if(is_numeric($stand)){
                $d=DB::table('fv_solicitud as f')->join('empresas as e','f.id_empresa','=','e.id_empresa')->where('f.codigo_fv',6)->where('f.id_empresa',$stand)->select('f.*','e.*')->first();
            if (!isset($d))
                return redirect()->back();
            else
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>$stand,'fecha'=>date('Y-m-d H:i:s')]);
            $d->logo=$d->id_empresa;
            $d->nombre_empresa=$d->nombre_stand!='' ? $d->nombre_stand : $d->nombre_empresa; 
            $ejecutivos=DB::table('fv_ejecutivo')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
            foreach($ejecutivos as $i=>$ejs){
                if(strpos($ejs->link,'https:')===false || strpos($ejs->link,'http:')===false)
                {
                    if(is_numeric($ejs->link))
                        if(strpos($ejs->link,'+')!==false)
                            $ejecutivos[$i]->link="https://wa.me/".substr($ejs->link,1)."?text=Quiero%20mas%20informacion";
                        else
                            $ejecutivos[$i]->link="https://wa.me/591".$ejs->link."?text=Quiero%20mas%20informacion";
                    else{
                        $ejecutivos[$i]->link="https://".$ejs->link;
                        $ejecutivos[$i]->modo_contacto=2;
                        }
                }
                else
                    if(strpos($ejs->link,'+')!==false)
                    {
                        $ejecutivos[$i]->link="https://wa.me/".substr($ejs->link,1)."?text=Quiero%20mas%20informacion";
                    }
                    else{
                        if(is_numeric($ejs->link))
                            $ejecutivos[$i]->link="https://wa.me/591".$ejs->link."?text=Quiero%20mas%20informacion";
                    }
            }
            $productos=DB::table('fv_producto')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
            $sucs=DB::table('fv_sucursal')->where('id_user',$d->id_empresa)->where('es_activo',1)->get();
            $ofertas=DB::table('fv_oferta')->where('id_user',$d->id_empresa)->where('es_activo',1)->select('*')->get();
            foreach($productos as $i=>$p){
      //          $productos[$i]->setAttribute('ofert',[]);
                if(strpos($p->caracteristicas,'https')!==false)
                    {
                        $subst=substr($p->caracteristicas,strpos($p->caracteristicas,'https'));
                        $subss=explode(' ',$subst);
                        $can=strlen($subss[0]);
                        $p->caracteristicas=substr_replace($p->caracteristicas,'</a>',strpos($p->caracteristicas,'https')+$can,0);
                        $productos[$i]->caracteristicas=substr_replace($p->caracteristicas,'<a href="'.$subss[0].'">',strpos($p->caracteristicas,'https'),0);
                    }
                $j=0;
                foreach($ofertas as $o){
                    $off=explode(";",$o->productos);
                    if(array_search($p->id_producto,$off)!==false)
                    {
                        $productos[$i]->ofert[$j]=$o;
        //                dd($productos[$i]->ofert);
                        //array_push($productos[$i]->ofert,$o);
                        $j++;
                    }
                }
    //            dd($productos[$i]);
            }
            if($d->video!=''){
            $texto=$d->video;
            if (strpos($texto, 'youtu.be') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://www.youtube.com/embed/".end($aux);
            }
            elseif (strpos($texto, 'youtube.com') !== false) {
                if(strpos($texto, 'embed') !== false)
                    $d->video=$texto;
                else
                {
                    $ini = strpos($texto, "v=");
                    $ini+=strlen("v=");
                    if(strpos($texto,"&",$ini)!==false)
                        {
                        $len=strpos($texto,"&",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);                
                    $d->video="https://www.youtube.com/embed/".$aux;
                }
            }
            elseif (strpos($texto, 'facebook.com') !== false) {
                if((strpos($texto, 'videos/') !== false))
                    $buscador="videos/";
                else
                    $buscador="watch/?v=";
                $ini = strpos($texto, $buscador);
                $ini+=strlen($buscador);
                if(strpos($texto,"/",$ini)!==false)
                    {
                    $len=strpos($texto,"/",$ini)-$ini;
                    $aux=substr($texto,$ini,$len);
                    }
                else
                    $aux=substr($texto,$ini);
                $d->video="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
            }
            elseif (strpos($texto, 'vimeo.com') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://player.vimeo.com/video/".end($aux);
            }
            }
            if($d->video2!=''){
                $texto=$d->video2;
                if (strpos($texto, 'youtu.be') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://www.youtube.com/embed/".end($aux);
                }
                elseif (strpos($texto, 'youtube.com') !== false) {
                    if(strpos($texto, 'embed') !== false)
                        $d->video2=$texto;
                    else
                    {
                        $ini = strpos($texto, "v=");
                        $ini+=strlen("v=");
                        if(strpos($texto,"&",$ini)!==false)
                            {
                            $len=strpos($texto,"&",$ini)-$ini;
                            $aux=substr($texto,$ini,$len);
                            }
                        else
                            $aux=substr($texto,$ini);                
                        $d->video2="https://www.youtube.com/embed/".$aux;
                    }
                }
                elseif (strpos($texto, 'facebook.com') !== false) {
                    if((strpos($texto, 'videos/') !== false))
                        $buscador="videos/";
                    else
                        $buscador="watch/?v=";
                    $ini = strpos($texto, $buscador);
                    $ini+=strlen($buscador);
                    if(strpos($texto,"/",$ini)!==false)
                        {
                        $len=strpos($texto,"/",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);
                    $d->video2="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
                }
                elseif (strpos($texto, 'vimeo.com') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://player.vimeo.com/video/".end($aux);
                }
                }    
            return view('visita.stand',['st'=>$d,'productos'=>$productos,'sucs'=>$sucs,'ejecutivos'=>$ejecutivos]);
    
        }
        else{
            $st=explode("_",$stand);
            $d=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',$st[0])->where('id_stand',$st[1])->select('*')->first();
            if (!isset($d))
                return redirect('visita');
            else
            DB::table('fv_visitas')->insert(['id_user'=>Cookie::get('user_id'),'stand'=>$stand,'fecha'=>date('Y-m-d H:i:s')]);
            $d->logo=$st[0]."_".$st[1];
            $d->nombre_empresa=$d->nombre;
            $d->nombre_stand=$d->nombre;
            $d->email_representante=$d->email;
            $d->telefono_responsable=$d->telefono;
            $ejecutivos=DB::table('fv_ejecutivo')->where('id_stand',$st[1])->where('es_activo',1)->where('id_user',$st[0])->select('*')->get();
            foreach($ejecutivos as $i=>$ejs){
                if(strpos($ejs->link,'https:')===false || strpos($ejs->link,'http:')===false)
                {
                    if(is_numeric($ejs->link))
                        if(strpos($ejs->link,'+')!==false)
                            $ejecutivos[$i]->link="https://wa.me/".substr($ejs->link,1)."?text=Quiero%20mas%20informacion";
                        else
                            $ejecutivos[$i]->link="https://wa.me/591".$ejs->link."?text=Quiero%20mas%20informacion";
                    else{
                        $ejecutivos[$i]->link="https://".$ejs->link;
                        $ejecutivos[$i]->modo_contacto=2;
                        }
                }
                else
                    if(strpos($ejs->link,'+')!==false)
                    {
                        $ejecutivos[$i]->link="https://wa.me/".substr($ejs->link,1)."?text=Quiero%20mas%20informacion";
                    }
                    else{
                        if(is_numeric($ejs->link))
                            $ejecutivos[$i]->link="https://wa.me/591".$ejs->link."?text=Quiero%20mas%20informacion";
                    }
            }
            $productos=DB::table('fv_producto')->where('id_stand',$st[1])->where('es_activo',1)->where('id_user',$st[0])->select('*')->get();
            $sucs=DB::table('fv_sucursal')->where('id_stand',$st[1])->where('es_activo',1)->where('id_user',$st[0])->get();
            $ofertas=DB::table('fv_oferta')->where('id_stand',$st[1])->where('es_activo',1)->where('id_user',$st[0])->where('es_activo',1)->select('*')->get();
            foreach($productos as $i=>$p){
      //          $productos[$i]->setAttribute('ofert',[]);
                $j=0;
                foreach($ofertas as $o){
                    $off=explode(";",$o->productos);
                    if(array_search($p->id_producto,$off)!==false)
                    {
                        $productos[$i]->ofert[$j]=$o;
        //                dd($productos[$i]->ofert);
                        //array_push($productos[$i]->ofert,$o);
                        $j++;
                    }
                }
    //            dd($productos[$i]);
            }
            if($d->video!=''){
            $texto=$d->video;
            if (strpos($texto, 'youtu.be') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://www.youtube.com/embed/".end($aux);
            }
            elseif (strpos($texto, 'youtube.com') !== false) {
                if(strpos($texto, 'embed') !== false)
                    $d->video=$texto;
                else
                {
                    $ini = strpos($texto, "v=");
                    $ini+=strlen("v=");
                    if(strpos($texto,"&",$ini)!==false)
                        {
                        $len=strpos($texto,"&",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);                
                    $d->video="https://www.youtube.com/embed/".$aux;
                }
            }
            elseif (strpos($texto, 'facebook.com') !== false) {
                if((strpos($texto, 'videos/') !== false))
                    $buscador="videos/";
                else
                    $buscador="watch/?v=";
                $ini = strpos($texto, $buscador);
                $ini+=strlen($buscador);
                if(strpos($texto,"/",$ini)!==false)
                    {
                    $len=strpos($texto,"/",$ini)-$ini;
                    $aux=substr($texto,$ini,$len);
                    }
                else
                    $aux=substr($texto,$ini);
                $d->video="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
            }
            elseif (strpos($texto, 'vimeo.com') !== false) {
                $aux=explode("/",$texto);
                $d->video="https://player.vimeo.com/video/".end($aux);
            }
            }
            if($d->video2!=''){
                $texto=$d->video2;
                if (strpos($texto, 'youtu.be') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://www.youtube.com/embed/".end($aux);
                }
                elseif (strpos($texto, 'youtube.com') !== false) {
                    if(strpos($texto, 'embed') !== false)
                        $d->video2=$texto;
                    else
                    {
                        $ini = strpos($texto, "v=");
                        $ini+=strlen("v=");
                        if(strpos($texto,"&",$ini)!==false)
                            {
                            $len=strpos($texto,"&",$ini)-$ini;
                            $aux=substr($texto,$ini,$len);
                            }
                        else
                            $aux=substr($texto,$ini);                
                        $d->video2="https://www.youtube.com/embed/".$aux;
                    }
                }
                elseif (strpos($texto, 'facebook.com') !== false) {
                    if((strpos($texto, 'videos/') !== false))
                        $buscador="videos/";
                    else
                        $buscador="watch/?v=";
                    $ini = strpos($texto, $buscador);
                    $ini+=strlen($buscador);
                    if(strpos($texto,"/",$ini)!==false)
                        {
                        $len=strpos($texto,"/",$ini)-$ini;
                        $aux=substr($texto,$ini,$len);
                        }
                    else
                        $aux=substr($texto,$ini);
                    $d->video2="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F".$aux."%2F&show_text=false&appId=307268372945483&";
                }
                elseif (strpos($texto, 'vimeo.com') !== false) {
                    $aux=explode("/",$texto);
                    $d->video2="https://player.vimeo.com/video/".end($aux);
                }
                }
            $stands=DB::table('fv_stand')->where('cod_fv',6)->where('id_user',$st[0])->get();
            return view('visita.stand',['st'=>$d,'productos'=>$productos,'sucs'=>$sucs,'stands'=>$stands,'sel'=>$stand,'ejecutivos'=>$ejecutivos]);
        }
    }
    else{
        return redirect('visita');
    }

    }
    public function guardar_stand(Request $request){
        if($request->hasFile('imagen_1'))
        {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_1.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_1.jpg");
            request()->imagen_1->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_1.jpg");
        }
        else
            if(!isset($request->check_imagen_1))
            {
                if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_1.jpg"))
                    unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_1.jpg");
            }
        if($request->hasFile('imagen_2'))
            {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_2.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_2.jpg");
            request()->imagen_2->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_2.jpg");
            }
        else
            if(!isset($request->check_imagen_2))
            {
                if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_2.jpg"))
                    unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_2.jpg");
            }
        if(!isset($request->check_imagen_3))
        {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_3.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_3.jpg");
            if($request->hasFile('imagen_3'))
                request()->imagen_3->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_3.jpg");
        }
        return redirect()->back()->with('status', 'Se guardaron los datos correctamente!');
    }
    public function guardar_stands(Request $request,$stand){
        if($request->hasFile('imagen_1'))
        {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_1.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_1.jpg");
            request()->imagen_1->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_".$stand."_1.jpg");
        }
        else
            if(!isset($request->check_imagen_1))
            {
                if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_1.jpg"))
                    unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_1.jpg");
            }
        if($request->hasFile('imagen_2'))
            {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_2.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_2.jpg");
            request()->imagen_2->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_".$stand."_2.jpg");
            }
        else
            if(!isset($request->check_imagen_2))
            {
                if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_2.jpg"))
                    unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_2.jpg");
            }
        if(!isset($request->check_imagen_3))
        {
            if(file_exists(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_3.jpg"))
                unlink(dirname(base_path()).'/fvirtual/public/img/stand_images/'.Auth::user()->id_empresa."_".$stand."_3.jpg");
            if($request->hasFile('imagen_3'))
                request()->imagen_3->move(dirname(base_path()).'/fvirtual/public/img/stand_images',Auth::user()->id_empresa."_".$stand."_3.jpg");
        }
        return redirect()->back()->with('status', 'Se guardaron los datos correctamente!');

    }
    public function encuesta(Request $data,$id){
        $rubro='';
        foreach($data['rubro'] as $r)
            if($r!='')
                $rubro.=($rubro=='' ? "" : ", ").$r;
        DB::table('fv_encuesta')->insert([
            'id_user'=>$id,
            'cod_fv'=>6,
            'rubro'=>$rubro,
            'informacion_recibida'=>$data['informacion_recibida'],
            'informacion_recibida_adic'=>$data['informacion_recibida_adic'],
            'plataforma_virtual'=>$data['plataforma_virtual'],
            'mot_posicionamiento_imagen'=>$data['mot_posicionamiento_imagen'],
            'mot_incrementar_cartera'=>$data['mot_incrementar_cartera'],
            'mot_lanzar_ofertas'=>$data['mot_lanzar_ofertas'],
            'mot_vende_productos'=>$data['mot_vende_productos'],
            'mot_promocionar_introducir'=>$data['mot_promocionar_introducir'],
            'mot_sugerencia'=>$data['mot_sugerencia'],
            'mejorar_registro'=>$data['mejorar_registro'],
            'mejorar_duracion'=>$data['mejorar_duracion'],
            'mejorar_stands'=>$data['mejorar_stands'],
            'mejorar_sugerencia'=>$data['mejorar_sugerencia'],
            'concreto_venta'=>$data['concreto_venta'],
            'monto_ventas'=>$data['monto_ventas'],
            'atencion_trato'=>$data['atencion_trato'],
            'apoyo_asesoramiento'=>$data['apoyo_asesoramiento'],
            'fecha_adecuada'=>$data['fecha_adecuada'],
            'publicidad'=>$data['publicidad'],
            'participar'=>$data['participar'],
            'fecha_llenado'=>date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('status','Gracias por su tiempo, la encuesta fué llenada correctamente');
    }
    function informe($id)
    {
        if (is_numeric($id))
        {
            $total=DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',Auth::user()->id_empresa)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->count();
            $unicos=count(DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',Auth::user()->id_empresa)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->groupBy('fv_visitas.id_user')->select('fv_visitas.id_user')->get());
            $repetidos=$total-$unicos;
            $mujeres=count(DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',Auth::user()->id_empresa)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->where('genero',0)->groupBy('fv_visitas.id_user')->select('fv_visitas.id_user')->get());
            $varones=$unicos-$mujeres;
            $edad=DB::select("SELECT CASE WHEN edad < 20 THEN '10 - 19' WHEN edad BETWEEN 20 and 29 THEN '20 - 29' WHEN edad BETWEEN 30 and 39 THEN '30 - 39' WHEN edad BETWEEN 40 and 49 THEN '40 - 49' WHEN edad BETWEEN 50 and 59 THEN '50 - 59' WHEN edad BETWEEN 60 and 69 THEN '60 - 69' WHEN edad BETWEEN 70 and 79 THEN '70 - 79' WHEN edad >= 80 THEN '80 - 99' WHEN edad IS NULL THEN 'Not Filled In (NULL)' END as age_range, COUNT(*) AS uso FROM fv_visitas INNER JOIN fv_ticket on fv_visitas.id_user=fv_ticket.id_ticket WHERE fv_visitas.stand=? AND fv_ticket.fecha_visita>=? and fv_ticket.fecha_visita<? GROUP BY age_range ORDER BY age_range DESC",[Auth::user()->id_empresa,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $horas=DB::select("SELECT HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) as hora, COUNT(*) AS uso FROM fv_visitas WHERE fv_visitas.stand=? AND fv_visitas.fecha>=? AND fv_visitas.fecha<? GROUP BY HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) ORDER BY HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) DESC",[Auth::user()->id_empresa,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $dias=DB::select("SELECT DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) as dia, COUNT(*) AS uso FROM fv_visitas WHERE fv_visitas.stand=? AND fv_visitas.fecha>=? AND fv_visitas.fecha<? GROUP BY DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) ORDER BY DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) DESC",[Auth::user()->id_empresa,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $visitantes=DB::table('fv_ticket as t')->join('fv_visitas as v','t.id_ticket','=','v.id_user')->where('v.stand',Auth::user()->id_empresa)->whereBetween('v.fecha',['2020-08-27 10:30:00','2020-09-01 00:00:00'])->groupBy("t.id_ticket")->select('t.nombre','t.email','t.id_ticket')->orderBy('t.nombre','ASC')->get();
        }
        else
        {
            $total=DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',$id)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->count();
            $unicos=count(DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',$id)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->groupBy('fv_visitas.id_user')->select('fv_visitas.id_user')->get());
            $repetidos=$total-$unicos;
            $mujeres=count(DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',$id)->where('fv_ticket.fecha_visita','>=','2020-08-27 10:30:00')->where('fv_ticket.fecha_visita','<','2020-09-01 00:00:00')->where('genero',0)->groupBy('fv_visitas.id_user')->select('fv_visitas.id_user')->get());
            $varones=$unicos-$mujeres;
            $edad=DB::select("SELECT CASE WHEN edad < 20 THEN '10 - 19' WHEN edad BETWEEN 20 and 29 THEN '20 - 29' WHEN edad BETWEEN 30 and 39 THEN '30 - 39' WHEN edad BETWEEN 40 and 49 THEN '40 - 49' WHEN edad BETWEEN 50 and 59 THEN '50 - 59' WHEN edad BETWEEN 60 and 69 THEN '60 - 69' WHEN edad BETWEEN 70 and 79 THEN '70 - 79' WHEN edad >= 80 THEN '80 - 99' WHEN edad IS NULL THEN 'Not Filled In (NULL)' END as age_range, COUNT(*) AS uso FROM fv_visitas INNER JOIN fv_ticket on fv_visitas.id_user=fv_ticket.id_ticket WHERE fv_visitas.stand=? AND fv_ticket.fecha_visita>=? and fv_ticket.fecha_visita<? GROUP BY age_range ORDER BY age_range DESC",[$id,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $horas=DB::select("SELECT HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) as hora, COUNT(*) AS uso FROM fv_visitas WHERE fv_visitas.stand=? AND fv_visitas.fecha>=? AND fv_visitas.fecha<? GROUP BY HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) ORDER BY HOUR(DATE_ADD(fecha,INTERVAL -4 HOUR)) DESC",[$id,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $dias=DB::select("SELECT DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) as dia, COUNT(*) AS uso FROM fv_visitas WHERE fv_visitas.stand=? AND fv_visitas.fecha>=? AND fv_visitas.fecha<? GROUP BY DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) ORDER BY DAY(DATE_ADD(fecha,INTERVAL -4 HOUR)) DESC",[$id,'2020-08-27 10:30:00','2020-09-01 00:00:00']);
            $visitantes=DB::table('fv_ticket as t')->join('fv_visitas as v','t.id_ticket','=','v.id_user')->where('v.stand',$id)->whereBetween('v.fecha',['2020-08-27 10:30:00','2020-09-01 00:00:00'])->groupBy("t.id_ticket")->select('t.nombre','t.email','t.id_ticket')->orderBy('t.nombre','ASC')->get();    
            $aux=explode("_",$id);
            $sts=DB::table('fv_stand')->where('id_stand',$aux[1])->where('id_user',$aux[0])->first();
        }
//        dd($visitantes);
//        dd(DB::table('fv_ticket as t')->join('fv_visitas as v','t.id_ticket','=','v.id_user')->where('v.stand',Auth::user()->id_empresa)->whereBetween('v.fecha',['2020-08-19 10:30:00','2020-08-24 00:00:00'])->select('t.nombre','t.email')->toSQL());
        //        $mensajes=DB::table('fv_mensaje')->where('id_user',Auth::user()->id)->select('*')->get();
//        $datos=DB::table('fv_visitas')->join('fv_ticket','fv_visitas.id_user','=','fv_ticket.id_ticket')->where('stand',Auth::user()->id)->select(DB::raw('id_user,edad,genero,ip,DATE_ADD(fecha,INTERVAL -4 HOUR) as fecha'))->get();
//        dd($datos);
        $pdf = new Fpdf();
        $pdf::AliasNbPages();
        $pdf::AddPage('P','legal');
        $pdf::Image("img/logo-colores.png",0,0,70);
        $pdf::SetFont('Arial','B',16);
        $pdf::Ln(30);
        $pdf::Cell(0,10,iconv('UTF-8', 'windows-1252', "RESULTADOS DE PARTICIPACIÓN"),0,0,'C');
        $pdf::Ln(8);
        if (is_numeric($id))
            $pdf::Cell(0,10,"EMPRESA ".iconv('UTF-8', 'windows-1252', Auth::user()->nombre_empresa),0,0,'C');        
        else
            $pdf::Cell(0,10,"EMPRESA ".iconv('UTF-8', 'windows-1252', $sts->nombre),0,0,'C');
        $pdf::Ln(12);
        $pdf::SetFont('Arial','B',12);
        $pdf::Cell(95,10,"VISITANTES AL STAND",0,0,'C');
        $pdf::Cell(95,10,"DE LOS CUALES",0,0,'C');
        $pdf::Ln(5);
        $pdf::SetFont('Arial','B',60);
        $pdf::Cell(95,40,$total,0,0,'C');
        $pdf::Cell(45,40,$unicos,0,0,'C');
        $pdf::Cell(45,40,$repetidos,0,0,'C');
        $pdf::Ln(10);
        $pdf::SetFont('Arial','B',10);
        $pdf::Cell(95,40,'',0,0,'C');
        $pdf::Cell(45,40,'VISITAS UNICAS',0,0,'C');
        $pdf::Cell(45,40,'VISITANTES QUE RETORNARON',0,0,'C');
        $pdf::Ln(22);
        $pdf::SetFont('Arial','B',12);
        $pdf::Cell(95,10,iconv('UTF-8', 'windows-1252', "POR GÉNERO"),0,0,'C');
        $pdf::Cell(95,10,"POR EDAD",0,0,'C');
        $pdf::Ln(8);
        $col1=array(100,100,255);
        $col2=array(255,100,100);
        $data = array('Varones' => $varones, 'Mujeres' => $mujeres);
        foreach($edad as $e)
            $dato[$e->age_range]=$e->uso;
        $pdf::PieChart(90, 45, $data, '%l: %v (%p)', array($col1,$col2));
        $pdf::SetXY(115,105);
        if(!empty($dato)){
            $pdf::BarDiagram(90, 45, $dato, '%l : %v (%p)', array(255,175,100),0,5);
        }
        $pdf::Ln(14);/*
        $pdf::SetFont('Arial','B',12);
        $pdf::Cell(0,10,iconv('UTF-8', 'windows-1252', "VISITANTES POR DÍA"),0,0,'C');
        foreach($dias as $d)
            $dato_d[$d->dia." de agosto"]=$d->uso;
        $pdf::Ln(8);
        if(!empty($dato_d)){
            $pdf::BarDiagram(180, 45, $dato_d, '%l : %v (%p)', array(255,175,100),0,5);
        }
        $pdf::Ln(14);*/
        $pdf::SetFont('Arial','B',12);
        $pdf::Cell(0,10,"VISITANTES POR HORA",0,0,'C');
        foreach($horas as $h)
            $dato_h[$h->hora.":00-".$h->hora.":59"]=$h->uso;
        $pdf::Ln(8);
        if(!empty($dato_h)){
            $pdf::BarDiagram(180, 112, $dato_h, '%l : %v (%p)', array(255,175,100),0,5);
        }
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',14);
        $pdf::Cell(0,10,"VISITANTES AL STAND",0,0,'C');
        $pdf::Ln(8);
        $pdf::SetFont('Arial','B',12);
        $pdf::Cell(100,10,"NOMBRE",0,0,'C');
        $pdf::Cell(80,10,"CORREO ELECTRONICO",0,0,'C');
        $pdf::Ln(8);
        $pdf::SetFont('Arial','',10);
        foreach($visitantes as $v)
            {
            $pdf::SetFont('Arial','',10);
            $aux=DB::table('fv_accion')->where('stand',$id)->where('id_user',$v->id_ticket)->select('fecha','accion')->get();
            $pdf::Cell(100,8,iconv('UTF-8','windows-1252',$v->nombre),1,0,'C');
            $pdf::Cell(80,8,$v->email,1,0,'C');
            $pdf::Ln(8);
            foreach($aux as $au)
            {
                $pdf::SetFont('Arial','',7);
                $pdf::Cell(10,8,iconv('UTF-8','windows-1252',''),0,0,'C');
                $pdf::Cell(120,8,iconv('UTF-8','windows-1252',$au->accion),1,0,'C');
                $pdf::Cell(50,8,iconv('UTF-8','windows-1252','Fecha: '.substr($au->fecha,8,2)." de ".substr($au->fecha,5,2)." de ".substr($au->fecha,0,4)),1,0,'C');
                $pdf::Ln(8);    
            }
            unset($aux);
            }
        $pdf::Output();
    }
}
