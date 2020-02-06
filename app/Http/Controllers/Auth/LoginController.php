<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Influencers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

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

    public function login(Request $request)
    {
        $data = $request->except('_token');

        //Login successfully
        $remember = ($data['remember']) ? true : false;
        $auth = Auth::guard('web')->attempt([
            'email'  => $data['email'],
            'password'  => $data['pass']
        ], $remember);

        if ($auth) {
            $user = User::withTrashed()
                ->with('influencer:id,user_id,status')
                ->findOrFail(Auth::user()->id);

            $saveIp = $user->update(['last_sign_in_ip' => $request->getClientIp()]);
            // influencer must verify email before login
            if ($user->user_type == 'influencer' && $user->email_verified_at == null) {
                Auth::logout();
                return back()->withInput()->withErrors(['errors' => 'You are influencer so please verify your email address!']);
            }
            if ($saveIp) {
                $url = session('previous_url') ?? route('home');
                if ($user->user_type == 'influencer') {
                    // status == 1 is approved
                    if ($user->influencer->status != Influencers::ACCEPTED) {
                        $this->logout();
                        return back()->withInput()->withErrors(['errors' => 'Please waiting for administrator confirm your account!']);
                    }
                    if ($url != route('home')) {
                        return redirect($url);
                    }
                    return \redirect()->route('influencer.products');
                } else if ($url != route('home')) {
                    return redirect($url);
                }
                else if ($user->user_type == 'customer') {
                    return \redirect()->route('customer.ordered');
                } else {
                    return \redirect()->route('admin.index');
                }
            }
        } else {
            return back()->withInput()->withErrors(['errors' => 'Your email or password was incorrect!']);
        }
    }

    public function logout() {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
