<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  Show change password form
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'old-password' => 'required',
            'new-password' => 'required|min:6',
            'password-confirm' => 'required|same:new-password'
        ]);

        $oldpass = $request->input('old-password');
        $newpass = $request->input('new-password');
        $passconfirm = $request->input('password-confirm');

        // if old password is not correct
        if(!Hash::check($oldpass, Auth::user()->getAuthPassword())) {
			return redirect('/password/change')->with('error', 'Old Password is not correct');
		}

		// save new password
		Auth::user()->fill([
            'password' => Hash::make($newpass)
        ])->save();


		return redirect('/dashboard')->with('success', 'Password Updated');
    }
}
