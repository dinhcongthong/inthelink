<?php

namespace App\Http\Controllers;

use App\Models\InthelinkInfo;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected $segment1;
    protected $segment2;
    protected $segment3;
    protected $project_name = ' Inthelink';

    public function __construct()
    {
        $this->segment1 = Request()->segment(1);
        $this->segment2 = Request()->segment(2);
        $this->segment3 = Request()->segment(3);

        // $pageTitle = $this->getTitle($this->segment1, $this->segment2, $this->segment3) . ' -' . $this->project_name;
        $pageTitle = 'IN THE LINK';
        $this->data['pageTitle'] = $pageTitle;
        $this->data['segment1'] = $this->segment1;
        $this->data['segment2'] = $this->segment2;
        $this->data['segment3'] = $this->segment3;
    }

    public function getTitle($segment1, $segment2, $segment3)
    {
        $title = '';
        if ($segment2 == 'ordered') {
            $title = 'Ordered';
            if ($segment3 == 'detail') {
                $title = $title . ' Detail';
            }
        }
        if ($segment2 == 'profile') $title = 'Profile';
        if ($segment2 == 'address') $title == 'Address';
        if ($segment2 == 'checkout') {
            $title = 'Checkout';
            if ($segment3 == 'checkoutsuccess') {
                $title = $title . ' Success';
            }
        }

        return $title;
    }

    public function checkAuthUserPage($role = 'customer')
    {
        $this->middleware(function ($request, $next) use ($role) {
            if (!Auth::user()) {
                session(['previous_url' => url()->current()]);
                return \redirect()->route('login');
            } elseif (Auth::user()->user_type == $role) {
                $this->user = Auth::user();
                return $next($request);
            } elseif (Auth::user()->user_type == 'admin' && $role == 'customer') {
                $this->user = Auth::user();
                return $next($request);
            } else {
                return abort(403);
            }
        });
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
