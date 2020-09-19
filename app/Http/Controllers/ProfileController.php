<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile (Request $request) {

        return view('profile.profile');
    }

    public function profile_save (Request $request){
        $user = auth()->user();
        // validate the response
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        // save the user info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->street = $request->street;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->county = $request->county;
        $user->country = $request->country;
        $user->mailinglist = (isset($request->mailinglist) == '1' ? '1' : '0');

        $user->save();

        return back()->with(['alert' => 'Successfully updated your profile info', 'alert_type' => 'success']);
    }

    public function security (Request $request) {

        return view('profile.security');
    }

    public function security_save (Request $request){

        $user = auth()->user();

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with(['alert' => 'Successfully updated your password', 'alert_type' => 'success']);
    }

}
