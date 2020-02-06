<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;


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

    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    public function check(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user)) {
            $passwordReset = PasswordReset::updateOrCreate([
                'email' => $user->email,
            ], [
                'token' => Str::random(60),
            ]);
            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($passwordReset->token));
            }
            $request->session()->flash('sent', 'We have e-mailed your password reset link!');
            return redirect()->back();
        } else {
            return back()->withErrors(['errors' => 'Your email does not exist!']);
        }
    }
    public function form_reset($token = '')
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        $this->data['token'] = $token;
        if ($passwordReset) {
            return view('auth.reset_password', $this->data);
        }
    }
    public function reset(Request $request)
    {
        $token = $request->token_reset;
        if ($request->password != $request->re_password) {
            return back()->withErrors(['errors' => 'Your password does not match!']);
        }
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update(
            ['password' => Hash::make($request->password)]
        );
        $passwordReset->delete();
        return redirect()->route('login')->with(['status' => 'Your password was changed']);
    }
}
