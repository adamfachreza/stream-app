<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $data = $request->except("_token");

        $isEmailExist = User::where('email', $request->email)->exists();

        if($isEmailExist){
            return back()->withErrors([
                'email' => 'This Email Already Exist'
            ])->withInput();
        }
        $data['password'] = Hash::make($request->password);
        $data['avatar'] = 'storage/avatar/user.jpeg';

        User::create($data);

        // dd($data);
        return redirect()->route('member.login');
    }


}
