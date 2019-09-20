<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManagerStatic as Image;
use Debugbar;
use App\Notifications\RegisteredUser;

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

        // send the user's information out by email
        $user->notify(new RegisteredUser());

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
        return view('users.edit')->with('user', Auth::user());
    }

    /**
     * Show the form for editing users by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Debugbar::error('Error!');

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
        //Debugbar::warning('Update');

        // check user is either admin or owner
        if(!Auth::user()->isAdmin() && Auth::user()->id != $id) {
            return redirect('/home')->with('error', 'Incorrect permissions.');
        }

        // validate data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'team_name' => 'sometimes|nullable|string|max:255',
            'profile_pic' => 'sometimes|nullable'
        ]);

        // update the User
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->team_name = $request->input('team_name');

        $is_admin = $request->input('is_admin') ? '1' : '0';
        // only check if the user was an admin and new status is 0 - not an admin
        // check if this is the only admin account, if so then fail
        if($user->is_admin == 1 && $is_admin == 0 && User::where('is_admin','=',1)->count() === 1) {
            return redirect()->back()->with('error', 'Cannot remove Administrator status from the only Administrator.')->withInput();
        }
        // if it didn't fail, assign the new admin status
        $user->is_admin = $is_admin;
        
        // if a file was uploaded
        if($request->file('profile_pic')) {
            // file upload
            $allowedfileExtension=['jpg','gif'];
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $path = public_path('storage/profile_pics/');
            $fileNameToStore = "id_".$id."_".time().'.'.$extension;
            
            if(in_array($extension,$allowedfileExtension)) {
                // delete existing file
                $oldFileWithPath = 'public/profile_pics/' . $user->profile_pic;
                if(Storage::exists($oldFileWithPath)) {
                    Storage::delete($oldFileWithPath);
                }
                // save new file in storage
                $imgPath = public_path('storage/profile_pics/' . $fileNameToStore);
                Debugbar::warning('imgPath');
                Image::make($file->getRealPath())
                    ->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($imgPath);
                //old method - save just in case
                //$path = $file->storeAs($path, $fileNameToStore);

                // save file name in user
                $user->profile_pic = $fileNameToStore;
            }
        }

        $user->save();
		return redirect('/users')->with('success', 'User Updated');

        // Only while debugging!!
        //return view('users.edit')->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        // check if this is the only admin account, if so then fail
        if($user->is_admin && User::where('is_admin','=',1)->count() === 1) {
            return redirect()->back()->with('error', 'Cannot delete the only Administrator. Please promote another user first.');
        }

        $user->delete();
        return redirect('/users')->with('success', 'User Deleted');
    }
}
