<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/app';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $user = \Auth::user();

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');

    }

    function authenticated(Request $request, $user)
    {
        //Spatie\Activity
        // activity('auth-log')
        // ->withProperties([
        //     'user_id' => $user->id,
        //     'tenant_id' => $user->tenant_id,
        //     'last_login_at' => Carbon::now()->toDateTimeString(),
        //     'last_login_ip' => $request->getClientIp(),
        //     ])
        // ->tap(function(Activity $activity) use($user) {
        //     $activity->tenant_id = $user->tenant_id;
        // })
        // ->on($user)
        // ->log("User Login");
        // dd(Activity::all()->last());

        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }

}
