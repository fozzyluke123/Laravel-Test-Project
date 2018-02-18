<?php

namespace App\Http\Controllers;

use DB;
use Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Update a single users details within the database
     *
     * @param int $id ID of the user to update
     * @return void
     */
    public function update($id, HttpRequest $request)
    {
        
        if ($request->isMethod('post')){
            //validate the inputs
            $validator = Validator::make(Request::all(), [
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                    "max:50"
                ],
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                    'max:50',
                    'email'
                ],
                'dob' => [
                    'required',
                    'before:today'
                ]
            ]);
            if ($validator->fails()) {
                return redirect('users/' . $id)
                            ->withErrors($validator)
                            ->withInput();
            }
            $update = User::where('id', Request::input("id"))->update(array(
                'username' 	  =>  Request::input("username"),
                'email' => Request::input("email"),
                'dob' => Request::input("dob")
            ));
            if ($update) {
                $message = "Record updated successfully!";
            } else {
                $message = "Oops, something went wrong!";
            }
            return view('users.profile', ['user' => User::findOrFail($id), 'message' => $message]);
        }
        return view('users.profile', ['user' => User::findOrFail($id), 'message' => '']);
    }

    /**
     * Displays all users
     *
     * @return void
     */
    public function index()
    {
        return view('users.index', ['data' => User::all()]);
    }

    /**
     * Displays a new user form
     *
     * @return void
     */
    public function new(HttpRequest $request)
    {
        if ($request->isMethod('post')){
            $validatedData = Request::validate([
                'username' => 'required|unique:users|max:50',
                'email' => 'required|unique:users|max:50|email',
                'dob' => 'required|before:today',
                'password' => 'required|max:50'
            ]);
            //get the password from the request and hash it for safe storage
            $password = Request::input('password');
            $hashedPassword = bcrypt($password);
            $add = DB::table('users')->insertGetID(
                [
                    'username' => Request::input("username"), 
                    'email' => Request::input("email"),
                    'dob' => Request::input("dob"),
                    'password' => $hashedPassword
                ]
            );
            if ($add) {
                $message = "Record added successfully!";
                //Redirect to profile edit page after successful form submit
                return redirect()->route('users.profile', ['id' => $add]);
            } else {
                //Keep the user on the current page and display an error message if the add fails
                $message = "Oops, something went wrong!";
                return view('users.new', ['message' => $message]);
            }
        }
        return view('users.new', ['message' => ""]);
    }

    /**
     * Show the login form and process a login request
     *
     * @param HttpRequest $request
     * @return void
     */
    public function login(HttpRequest $request)
    {
        if ($request->isMethod('post')){
            //make sure the request adheres to basic valdiation
            Request::validate([
                'username' => 'required|max:50',
                'password' => 'required|max:50'
            ]);
            //retrieve the profile with this username from the db
            $username = $request["username"];
            $password = $request["password"];
            $user = User::where("username", $username)->first();
            if (!$user) {
                //Fail auth TODO
            }
            $hashedPassword = $user["password"];
            
            //checking the entered password with the stored one
            if (Hash::check($password, $hashedPassword)) {
                // The passwords match, so log the user in
                if (Auth::loginUsingId($user["id"])) {
                    // Authentication passed...
                    return redirect()->intended('users');
                }
            } else {
                //Fail auth TODO
            }
        } elseif (Auth::check()) {
            return redirect()->intended('users');
        }
        return view('users.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('');
    }
}