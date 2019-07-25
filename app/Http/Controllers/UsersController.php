<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['editLoggedIn', 'update']]);
        $this->middleware('auth', ['only' => ['editLoggedIn', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'new_name' => 'required|string|max:255',
            'new_email' => 'required|email|string|max:255|unique:users,email',
            'team_name' => 'sometimes|nullable|string|max:255',
            'profile_pic' => 'sometimes|nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // update the User
        $user = new User;
        $user->name = $request->input('new_name');
        $user->team_name = $request->input('team_name');
        $user->email = $request->input('new_email');
        $user->password = Hash::make($request->input('password'));
        //$user->profile_pic = $request->input('profile_pic');
        $user->save();

        return redirect('/users')->with('success', 'New User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the currently logged in user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editLoggedIn()
    {
        return view('users.edit');
    }

    /**
     * Show the form for editing users by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check user is either admin or owner
        if(!Auth::user()->isAdmin() && Auth::user()->id != $id) {
            return redirect('/home')->with('error', 'Incorrect permissions.');
        }

        // validate data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'sometimes|nullable|string|max:255',
            'profile_pic' => 'sometimes|nullable|string|max:255'
        ]);

        // update the User
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->team_name = $request->input('team_name');
        $user->is_admin = $request->input('is_admin');
        $user->save();

		return redirect('/users')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}