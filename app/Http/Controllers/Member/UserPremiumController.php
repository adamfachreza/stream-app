<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPremiumController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $userPremium = UserPremium::with('package')->where('user_id', $userId)->first();

        if(!$userPremium){
            return redirect()->route('pricing');
        }
        $endOfSubscription = Carbon::parse($userPremium->end_of_subscription);
        $now = Carbon::now();

        $daysLeft = $endOfSubscription->diffInDays($now);
        $daysLeftPercentage = ($daysLeft / $userPremium->package->max_days) * 100;

        return view('member.subscription',['user_premium' => $userPremium,'daysLeft' => $daysLeft,'days_left_percentage' => $daysLeftPercentage]);
    }

    public function destroy($id)
    {
        UserPremium::destroy($id);
        return redirect()->route('member.dashboard');
    }
}
