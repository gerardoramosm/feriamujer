<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use Fpdf;
use Cookie;

class ActividadController extends Controller
{
    //
    public function __construct()
    {
    }
    public function whatsapp($stand,$wpp,$texto){
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Ingreso a Whatsapp '.$wpp.' con mensaje '.$texto,'stand'=>$stand]);
        return redirect('https://wa.me/'.$wpp.'?text='.$texto);
    }
    public function facebook($stand){
        if(is_numeric($stand))
            $fb=DB::table('fv_solicitud')->where('id_empresa',$stand)->where('codigo_fv',6)->select('fb')->first();
        else
        {
            $aux=explode("_",$stand);
            $fb=DB::table('fv_stand')->where('id_user',$aux[0])->where('id_stand',$aux[1])->select('fb')->first();
        }
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Visita a Link de Facebook','stand'=>$stand]);
        if(strpos($fb->fb,'http')!==false)
            return redirect($fb->fb);
        else
            return redirect('https://'.$fb->fb);
    }
    public function instagram($stand){
        if(is_numeric($stand))
            $ig=DB::table('fv_solicitud')->where('id_empresa',$stand)->where('codigo_fv',6)->select('ig')->first();
        else
        {
            $aux=explode("_",$stand);
            $ig=DB::table('fv_stand')->where('id_user',$aux[0])->where('id_stand',$aux[1])->select('ig')->first();
        }
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Visita a Link de Instagram','stand'=>$stand]);
        if(strpos($ig->ig,'http')!==false)
            return redirect($ig->ig);
        else
            return redirect('https://'.$ig->ig);
    }
    public function twitter($stand){
        if(is_numeric($stand))
            $tw=DB::table('fv_solicitud')->where('id_empresa',$stand)->where('codigo_fv',6)->select('tw')->first();
        else
        {
            $aux=explode("_",$stand);
            $tw=DB::table('fv_stand')->where('id_user',$aux[0])->where('id_stand',$aux[1])->select('tw')->first();
        }
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Visita a Link de Instagram','stand'=>$stand]);
        if(strpos($tw->tw,'http')!==false)
            return redirect($tw->tw);
        else
            return redirect('https://'.$tw->tw);
    }
    public function youtube($stand){
        if(is_numeric($stand))
            $yt=DB::table('fv_solicitud')->where('id_empresa',$stand)->where('codigo_fv',6)->select('yt')->first();
        else
        {
            $aux=explode("_",$stand);
            $yt=DB::table('fv_stand')->where('id_user',$aux[0])->where('id_stand',$aux[1])->select('yt')->first();
        }
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Visita a Link de Instagram','stand'=>$stand]);
        if(strpos($yt->yt,'http')!==false)
            return redirect($yt->yt);
        else
            return redirect('https://'.$yt->yt);
    }
    public function ejecutivo($stand,$ejecutivo){
        $ej=DB::table('fv_ejecutivo')->where('id_ejecutivo',$ejecutivo)->first();
        DB::table('fv_accion')->insert(['id_user'=>Cookie::get('user_id'),'fecha'=>date('Y-m-d H:i:s'),'accion'=>'Click en botón de contacto de ejecutivo '.$ej->nombre,'stand'=>$stand]);
        if($ej->modo_contacto==1)
        {
            if(is_numeric($ej->link))
                return redirect('https://wa.me/591'.$ej->link.'?text=Quiero%20mas%20informacion');
            else
                return redirect('https://wa.me/'.substr($ej->link,1).'?text=Quiero%20mas%20informacion');
        }
        else{
            return redirect($ej->link);
        }
    }
}
