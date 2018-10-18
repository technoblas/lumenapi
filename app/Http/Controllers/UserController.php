<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'gender' => [
                'required',
                Rule::in(['male', 'female']),
            ],
            'phone' => 'required|min:4',
            'type' => [
                'required',
                Rule::in(['standard', 'admin']),
            ],
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->status = 1; // default active
        $user->save();

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
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
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:6',
            'gender' => [
                'required',
                Rule::in(['male', 'female']),
            ],
            'phone' => 'required|min:4',
            'type' => [
                'required',
                Rule::in(['standard', 'admin']),
            ],
            'status' => [
                'required',
                Rule::in([1, 0]),
            ],
        ]);

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->type = $request->type;
        $user->status = $request->status;
        $user->save();

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json('Resource removed successfully');
    }
}
