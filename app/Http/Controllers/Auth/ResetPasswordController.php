<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use DB;
use Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }
    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $emp=DB::table('password_resets')->whereRaw('created_at>=DATE_SUB(NOW(),INTERVAL 1 HOUR)')->select('email','token')->get();
//        $emp=DB::table('password_resets')->where('created_at','>=','DATE_SUB(NOW(),INTERVAL 10 HOUR)')->select('email','token')->get();
//        dd($emp);
        foreach($emp as $e)
        {
            if(Hash::check($token,$e->token))
                {
                $aux=$e->email;
                break;
                }
        }
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => (isset($aux) ? $aux : '')]
        );
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $empr=DB::table('empresas as e')->join('fv_solicitud as f','f.id_empresa','=','e.id_empresa')->where('e.email_representante',$request->email_representante)->where('f.estado',1)->where('f.codigo_fv',6)->select('e.id_empresa')->first();
        $request->request->add(['password'=>$request->pass,'password_confirmation'=>$request->pass_confirmation]);
        if(isset($empr))
            $request->request->add(['id_empresa'=>$empr->id_empresa]);
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
//        dd($this->validate($request, $this->rules(), $this->validationErrorMessages()));
//dd($user);
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email_representante', 'pass', 'password', 'pass_confirmation', 'password_confirmation', 'token','id_empresa'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->pass = $password;

        $user->setRememberToken(Str::random(60));

        $user->save();

        Auth::loginUsingId($user->id_empresa);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email_representante' => 'required|email',
            'pass' => 'required|confirmed|min:6',
        ];
    }

}
