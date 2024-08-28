<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

         $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            switch (auth()->user()->is_role) {
                case 'patient':
                    return redirect()->route('patient.appointment.index');
                    break;
                case 'doctor':
                    return redirect()->route('doctor.dashboard.index');
                    break;
                case 'admin':
                    return redirect()->route('admin.dashboard.index');
                    break;
                default:
                    abort(403);
                    break;
            }
        }else{
            return redirect()->route('guest.index')
                ->with('error','Invalid Credentials');
        }



    }
}
