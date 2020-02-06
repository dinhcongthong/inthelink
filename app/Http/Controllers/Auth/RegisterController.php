<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Influencers;
use App\Models\Seller;
use App\Models\Social;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Mail\Verify_email;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    private function validatorData($type = '')
    {
        $validateData = [
            'user_name' => 'required',
            'agree' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            // 'gender' => 'required|numeric',
            // 'date' => 'required|numeric',
            // 'month' => 'required|numeric',
            // 'year' => 'required|numeric',
        ];
        if ($type == 'influencer') {
            $validateData['bank_name'] = 'required|max:50';
            $validateData['bank_acc_num'] = 'required|numeric';
            $validateData['bank_acc_name'] = 'required|max:40';
        }
        return $validateData;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        // parse_str($request->body, $data);
        $data = $request->except('_token');

        if ($data['position'] == 'influencer') {
            $validator = $request->validate($this->validatorData('influencer'));
        } else {
            $validator = $request->validate($this->validatorData());
        }
        // $birthday = $data['year'] . '-' . $data['month'] . '-' . $data['date'];
        // $timestamp = date('Y-m-d', strtotime($birthday));
        $status = 'You just created your account successfully!';
        $user = User::create([
            'user_type' => $data['position'],
            'user_name'   => $data['user_name'],
            // 'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => $data['password'],
            'mobile' => $data['phone'],
            // 'birthday' => $timestamp,
            'last_sign_in_ip' => $request->getClientIp(),
            'remember_token' => $request->header('Authorization'),
        ]);
        // influencer must verify email before register success
        if ($data['position'] == 'influencer') {
            // update verify code for influencer
            $confirmation_code = Str::uuid();
            $user_update = User::find($user->id)->update(['verify_code' => $confirmation_code]);
            $influencer = Influencers::create([
                'user_id' => $user->id,
                'bank_name' => $data['bank_name'],
                'bank_acc_name' => $data['bank_acc_name'],
                'bank_acc_num' => $data['bank_acc_num']
            ]);
            foreach ($data['social'] as $key => $value) {
                if (!is_null($value)) {
                    Social::create([
                        'influencer_id' => $influencer->id,
                        'link' => $value,
                    ]);
                }
            }

            Mail::to($data['email'])->send(new Verify_email($confirmation_code));
            if (!Mail::failures()) {
                $status = 'We have sent an authentication link to your email. Please check and confirm your account.';
            } else {
                return back()->withInput()->withErrors(['errors' => 'Sorry your email was error we can not send verify email for you!']);
            }
        }

        return \redirect()->route('login')->with(['status' => $status]);
    }
    public function verify($code)
    {
        $user = User::where('verify_code', $code)->first();

        if ($user->count() > 0) {
            $user->update([
                'email_verified_at' => Carbon::now()
            ]);
            $notification_status = 'Your email was confirmed. Please waiting for administrator confirm your email!';
        } else {
            $notification_status = 'Confirmation code is incorrect';
        }

        // session()->flash('status', $notification_status);
        return \redirect()->route('login')->with(['status' => $notification_status]);
    }
}
