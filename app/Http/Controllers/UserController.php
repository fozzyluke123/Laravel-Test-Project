<?php

namespace App\Http\Controllers;

use DB;
use Request;
use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Carbon;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('users.profile', ['user' => User::findOrFail($id), 'message' => '']);
    }

    /**
     * Update a single users details within the database
     *
     * @param int $id ID of the user to update
     * @return void
     */
    public function update($id)
    {
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

    /**
     * Add a new user to the database
     *
     * @param int $id ID of the user to update
     * @return void
     */
    public function add()
    {
        $validatedData = Request::validate([
            'username' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|max:50|email',
            'dob' => 'required|before:today',
        ]);
        $add = DB::table('users')->insertGetID(
            [
                'username' => Request::input("username"), 
                'email' => Request::input("email"),
                'dob' => Request::input("dob")
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
    public function new()
    {
        return view('users.new', ['message' => ""]);
    }
}