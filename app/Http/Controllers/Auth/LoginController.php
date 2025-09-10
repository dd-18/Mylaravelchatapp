<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
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
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated($request, $user)
    {
        // Check if the user is blocked
        if ($user->is_blocked) {
            // Log out the user if they are blocked
            Auth::logout();

            // Redirect the user with an error message
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been blocked.'
            ]);
        }

        // If the user checked "Remember me", remember them for longer sessions
        if ($request->has('remember') && $request->remember == 'on') {
            Auth::login($user, true); // "true" enables the "Remember Me" functionality
        }

        // Proceed with the default functionality if the user is not blocked
        return redirect()->intended($this->redirectPath());
    }
}
