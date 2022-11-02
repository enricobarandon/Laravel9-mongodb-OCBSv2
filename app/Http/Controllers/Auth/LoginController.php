<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

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
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo() 
    {
        $user = Auth::user();
        
        $role = $user->user_type_id;
        
        switch ($role) {
            case '1':
                return '/admin';
                break;
            case '2':
                return '/cashier';
                break;
            case '3':
                // Teller
                return '/cashier';
                break;
            case '4':
                // Cashier and Teller
                return '/cashier';
                break;
            default:
                return '/home';
                break;
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $user = Auth::user();
            
            ActivityLog::create([
                'type'      => 'login',
                'user_id'   => $user->_id,
                'assets'    => json_encode([
                    'action'    => 'User login',
                    'username'  => $user->username,
                    'full_name' => $user->first_name . ' ' . $user->last_name,
                    'user_role' => $user->user_type->role
                ])
            ]);

            if ($user->is_active == 0) {
                Auth::logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return back()
                    ->withErrors([
                        'password' => 'User account is Deactivated. Please contact a administrator to activate your account.',
                ]);
            }

            return $this->sendLoginResponse($request);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        // $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username'   => 'required|string',
            'password'   => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        // $request->session()->regenerate();
        $request->session()->regenerate();
        $previous_session = Auth::user()->session_id;
        if ($previous_session) {
            \Session::getHandler()->destroy($previous_session);
        }

        Auth::user()->session_id = \Session::getId();
        $cashierRoles = [2,3,4];
        if (in_array(Auth::user()->user_type_id, $cashierRoles)) {
            Auth::user()->is_allowed = 0;
        }
        Auth::user()->save();

        // $this->clearLoginAttempts($request);
        
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return redirect()->intended($this->redirectTo());
        
        // return $request->wantsJson()
        //             ? new JsonResponse([], 204)
        //             : redirect()->intended($this->redirectPath());
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }
}
