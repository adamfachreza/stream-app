<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function edit()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        //  dd($user);
        return view('member.setting', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'avatar' => 'image|mimes:jpeg,jpg,png',
            'password' => 'required|min:6'
        ]);
        $user = User::find($id);
        $data['password'] = Hash::make($request->password);

        if ($request->avatar) {
            // save new image
            $avatar = $request->avatar;
            $originalAvatarName = Str::random(10).$avatar->getClientOriginalName();
            $avatar->storeAs('public/avatar', $originalAvatarName);
            $data['avatar'] = $originalAvatarName;

            // delete old image
            Storage::delete('public/avatar/'.$user->avatar);
        } else {
            // use old image
            $data['avatar'] = $user->avatar;
        }

        $user->update($data);

       return redirect()->route('member.setting')->with('success', 'User updated');

    }
}
