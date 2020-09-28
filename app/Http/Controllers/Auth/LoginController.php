<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'nit';
    }
    
    public function login(Request $request)
    {
//        dd($request);
        $query=DB::table('empresas as e')->join('fv_solicitud as c','e.id_empresa','=','c.id_empresa')->where('c.estado',1)->where('c.codigo_fv',6)->where('e.nit',$request->nit)->where('e.pass',$request->pass)->select('e.*')->first();
        if(isset($query))
        {
            Auth::loginUsingId($query->id_empresa);
            return redirect('/home');
        }
        $errors = [$this->username() => trans('auth.failed')];
        return redirect()->back()->withErrors($errors);
    }
}
