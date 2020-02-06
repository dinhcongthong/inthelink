<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Gallery;
use App\Models\Influencers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function register($position = '')
    {
        $position = strtolower($position);

        if ($position == '') {
            if (Auth::check()) {
                return 'Sorry! You already login. Please logout to register new account';
            }
            return view('auth.roles', $this->data);
        } else {
            if ($position != 'customer' && $position != 'influencer') \abort(404);
            $this->data['position'] = $position;
            return view('auth.register', $this->data);
        }
    }

    public function login()
    {
        if (Auth::check()) {
            return 'Sorry! You already login. Please logout to login again';
        } else {
            return view('auth.login');
        }
    }

    public function ProductDetail(Request $request, $article = '')
    {
        if (!Auth::check()) {
            session(['previous_url' => url()->full()]);
        }
        $key = strrpos($article, '-');
        $article_id = substr($article, $key + 1);

        $article = Product::with('getImgs')
            ->with(['getCategory' => function ($query) {
                $query->with('getParent')->select('id', 'name', 'parent_id');
            }])
            ->with(['getEvaluations' => function ($query) {
                $query->with(['getUser'])->select('id', 'user_id', 'product_id', 'content', 'stars_number', 'updated_at');
            }])
            ->withCount('getEvaluations')
            ->findOrFail($article_id);

        // load more comment 
        if ($request->ajax()) {
            $loadMoreComment = $article->getEvaluations()
                ->select('user_id', 'stars_number', 'updated_at', 'content')
                ->with(['getUser' => function ($query) {
                    $query->select('id', 'user_name')->with('getAvatar');
                }])
                ->paginate(2)->setPath(url()->full());

            $cmtData = [];
            $nested['nextPageUrl'] = $loadMoreComment->nextPageUrl();

            foreach ($loadMoreComment as $item) {
                $nested['user_name'] = $item->getUser->user_name;
                $nested['updated_at'] = $item->updated_at->format('Y-m-d');
                $nested['content'] = $item->content;
                $nested['stars'] = $item->stars_number;
                $nested['avatarUrl'] = optional($item->getUser->getAvatar)->url ?? asset('images/overview/user-no-avatar.png');
                $data[] = $nested;
            }
            return response()->json($data);
        }

        // get analytic number
        $count = 0;
        $totalStars = 0;
        $totalCmt = 0;
        foreach ($article->getEvaluations as $item) {
            if (!is_null($item->stars_number)) {
                $count++;
                $totalStars = $totalStars + $item->stars_number;
            }
            if (!is_null($item->content)) {
                $totalCmt++;
            }
        }
        $starsNumber = $count != 0 ? $totalStars / $count : 0;
        $article['starNumber'] = round($starsNumber, 1);
        $article['totalComment'] = $totalCmt;

        $this->data['article'] = $article;
        $position = optional(Auth::user())->user_type == 'influencer' ? 'influencer' : 'customer';
        // return $article;
        return view($position . '.product.detail', $this->data);
    }

    public function profileUpdate(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $influencer = Influencers::whereUserId(Auth::user()->id)->first();

        $data_validate = [
            'user_name' => 'required|max:50',
            'mobile' => 'required|max:20',
            'email' => 'required|max:100,email|unique:users,email,' . Auth::user()->id,
            // 'gender' => 'required|numeric',
            // 'year' => 'required|numeric|min:1900',
            // 'month' => 'required|numeric|min:1|max:12',
            // 'date' => 'required|numeric|min:1|max:31',
            'password_new' => 'nullable|required_with:password_confirm|same:password_confirm|min:6',
            'avatar_thumb.*' => 'nullable|mimes:svg,png,jpeg,jpg|max:6150'
        ];

        if (!is_null($request->password) && !Hash::check($request->password, Auth::user()->password)) {
            return back()->withInput()->withErrors(['errors' => 'Your old password did not match']);
        }

        if (Auth::user()->user_type == 'influencer') {
            $data_validate['identity_font_thumb.*'] = 'nullable|mimes:svg,png,jpeg,jpg|max:6150';
            $data_validate['identity_back_thumb.*'] = 'nullable|mimes:svg,png,jpeg,jpg|max:6150';
            $data_validate['bank_acc_name'] = 'required|max:100';
            $data_validate['bank_acc_num'] = 'required|max:20';
            $data_validate['bank_thumb.*'] = 'nullable|mimes:svg,png,jpeg,jpg|max:6150';
        }

        $validator = $request->validate($data_validate);
        $birthday = $request->year . '-' . $request->month . '-' . $request->date;

        try {
            if ($request->hasFile('identity_font_thumb')) {
                if (!empty($influencer->getIdentityFontThumb()->first())) {
                    Gallery::deleteImages(Influencers::INFLUENCER_PROFILE, $influencer->getIdentityFontThumb()->first()->id);
                }
                Gallery::uploadImages(Influencers::INFLUENCER_PROFILE, $request->identity_font_thumb, Influencers::IDENTITY_FONT_THUMB, $influencer->id);
            }

            if ($request->hasFile('identity_back_thumb')) {
                if (!empty($influencer->getIdentityBackThumb()->first())) {
                    Gallery::deleteImages(Influencers::INFLUENCER_PROFILE, $influencer->getIdentityBackThumb()->first()->id);
                }
                Gallery::uploadImages(Influencers::INFLUENCER_PROFILE, $request->identity_back_thumb, Influencers::IDENTITY_BACK_THUMB, $influencer->id);
            }

            // upload avatar
            if ($request->hasFile('avatar_thumb')) {
                if (!empty(Auth::user()->getAvatar)) {
                    Gallery::deleteImages(User::USER_PROFILE, Auth::user()->getAvatar->id);
                }
                Gallery::uploadImages(User::USER_PROFILE, $request->avatar_thumb, 0, Auth::user()->id);
            }

            $user_data = [
                'email' => $request->email,
                'user_name' => $request->user_name,
                'password' => $request->password_new ?? Auth::user()->password,
                'mobile' => $request->mobile,
                // 'gender' => $request->gender,
                // 'birthday' => $birthday
            ];

            $user = User::findOrFail(Auth::user()->id)->update($user_data);

            if (Auth::user()->user_type == 'influencer') {
                $influencer_data = [
                    'user_id' => Auth::user()->id,
                    'bank_name' => $request->bank_name,
                    'bank_acc_num' => $request->bank_acc_num,
                    'bank_acc_name' => $request->bank_acc_name
                ];

                $influencer->update($influencer_data);
            }
            
            // save session check success
            $request->session()->flash('status', true);
            return back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Have errors when proccessing!']);
        }
    }

    public function influencer()
    {
        return view('influencer');
    }

    public function team()
    {
        return view('team');
    }
}
