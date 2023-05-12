<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('member.auth');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'member';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $ipAddress = $request->ip();
            $userLogin = new UserLogin();
            $userLogin->user_id = Auth::user()->id;
            $userLogin->ip_address = $ipAddress;

            $userCount = UserLogin::where('user_id', auth()->id())->count();

            $maxLoginCount = UserPremium::where('user_id', auth()->id())->first()->package->max_users ?? 1;
            // dd($userCount);

            if ($userCount < $maxLoginCount) {
                // user yang login kurang dari atau sama dengan jumlah maksimum yang diizinkan
                // User::where('email', $request->email)->update(['is_logged_in' => true]);

                $userLogin->save();
                return redirect()->route('member.dashboard');
            } else {
                // user yang login melebihi jumlah maksimum yang diizinkan
                Auth::logout();

                return back()->withErrors([
                    'credentials' => 'Maximum login limit exceeded'
                ])->withInput();
            }
        }
    }



    public function logout(Request $request)
    {
        $ipAddress = $request->ip();
        // $userId = Auth::user()->id;
        $userLogin = UserLogin::where('ip_address', $ipAddress)->first();

        // dd($userId);

        if ($userLogin) {
            $userLogin->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle(Request $request)
    {
        $callback = Socialite::driver('google')->stateless()->user();
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s',time()),
        ];

        // return $data;
        $user = User::firstOrCreate(['email'=>$data['email']],$data);
        Auth::login($user, true);
        $ipAddress = $request->ip();
        $userLogin = new UserLogin();
        $userLogin->user_id = Auth::user()->id;
        $userLogin->ip_address = $ipAddress;
        $userLogin->save();
        return redirect(route('member.dashboard'));
    }


}
