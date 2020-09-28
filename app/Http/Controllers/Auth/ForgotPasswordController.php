<?php

namespace App\Http\Controllers\Auth;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use DB;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $emp=DB::table('empresas as e')->join('fv_solicitud as f','f.id_empresa','=','e.id_empresa')->where('e.nit',$request->nit)->where('f.estado',1)->where('f.codigo_fv',6)->select('e.email','e.email_representante')->first();
//        dd($emp);
        if(isset($emp))
        {
//            dd($this->broker());
            $response = $this->broker()->sendResetLink(
                ['nit'=>$request->nit,'email_representante'=>$emp->email_representante]
            );    
        }
        else
            $response='passwords.nit';

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response,$emp->email_representante)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['nit' => 'required']);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse($response,$email)
    {
        $em=explode('@',$email);
        $aux=strlen($em[0]);
        $emaux='';
        for($i=3;$i<$aux;$i++)
            $emaux.='*';
        $emaux=substr($em[0],0,3).$emaux;
        return back()->with('status', trans($response,['correo'=>($emaux.'@'.$em[1])]));
    }

}
