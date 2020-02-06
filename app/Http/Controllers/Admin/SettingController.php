<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\Gallery;
use App\Models\InthelinkInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkAuthAdmin();
    }


    //setting-profile
    public function Profile()
    {
        return view('admin.setting.profile', $this->data);
    }

    public function postUpdateProfile(Request $request)
    {
        try {
            $data = [
                'user_name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'gender' => $request->gender,
                'birthday' => $request->year . '-' . $request->month . '-' . $request->date
            ];
            if ($request->hasFile('avatar')) {
                if (!empty(Auth::user()->getAvatar)) {
                    Gallery::deleteImages(User::USER_PROFILE, Auth::user()->getAvatar->id);
                }
                Gallery::uploadImages(User::USER_PROFILE, array($request->avatar), 0, Auth::user()->id);
            }

            $user = User::whereId(Auth::user()->id)->update($data);
            $request->session()->flash('status', true);
            return back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }

    // pending
    public function changeUserPassword(Request $request)
    {
        $password = $request->password;
        $new_pass = $request->newPassword;
        $pass_confirm = $request->passConfirm;

        if (Hash::check($password, Auth::user()->password)) {
            if ($new_pass === $pass_confirm) {
                $user = User::whereId(Auth::user()->id)->update(['password' => Hash::make($new_pass)]);
                if ($user) {
                    return 1;
                }
            }
        }
        return 0;
    }

    //setting-company
    public function inthelink()
    {
        $info = InthelinkInfo::with('getEditor:id,user_name')->first();
        $this->data['info'] = $info;
        return view('admin.setting.inthelink', $this->data);
    }

    public function postInthelink(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['editor_id'] = Auth::user()->id;
            InthelinkInfo::first()->update($data);
            return back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withInput()->withErrors(['errors' => 'Have errors when proccessing']);
        }
    }
}
