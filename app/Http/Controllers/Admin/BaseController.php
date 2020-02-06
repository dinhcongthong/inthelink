<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InthelinkInfo;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->data['segment1'] = Request()->segment(1);
        $this->data['segment2'] = Request()->segment(2);
        $this->data['segment3'] = Request()->segment(3);
    }

    public function getLogin()
    {
        return view('admin.login', $this->data);
    }

    public function postLogin(Request $request)
    {
        $user_name = $request->user_name;
        $password = $request->password;
        $auth = Auth::guard('web')->attempt([
            'user_name'  => $user_name,
            'password'  => $password,
            'user_type' => 'admin'
        ]);
        if ($auth) {
            if ($request->session()->has('admin_previous_url')) {
                $url = session('admin_previous_url');
                $request->session()->forget('admin_previous_url');
                if ($url == route('admin.login') || $url == route('admin.index')) {
                    return redirect()->route('admin.index');
                }
                return redirect($url);
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return back()->withErrors(['errors' => 'Your username or password was incorrect!']);
        }
    }

    public function Overview()
    {
        return view('admin.overview.index', $this->data);
    }

    public function checkAuthAdmin()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user() || Auth::user()->user_type != 'admin') {
                \session(['admin_previous_url' => Request()->fullUrl()]);
                return \redirect()->route('admin.login');
            } else {
                $this->user = Auth::user();
                return $next($request);
            }
        });
    }
}
