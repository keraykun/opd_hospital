<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('signed')->only('verify'); // Ensures the URL has a valid signature
        $this->middleware('throttle:6,1')->only('verify'); // Limits the number of verification attempts
    }

    // Override the default verification method
    public function verify(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        Auth::login($user);
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        if (Auth::user()->markEmailAsVerified()) {
            event(new Verified(Auth::user()));
        }

        //$this->guard()->login(Auth::user()); // Log in the user

        return redirect($this->redirectPath())->with('verified', true);
    }
}
