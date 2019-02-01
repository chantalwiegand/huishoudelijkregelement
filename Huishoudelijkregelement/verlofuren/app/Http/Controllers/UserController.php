<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Picqer\Financials\Exact\Employee;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', ['user' => $user]);
    }

    public function create()
    {
        if (\Auth::user()->hasPermission('add_employee')) {
            $route = route('user.create');
            $user = new User();
            return view('user.create', compact('user', 'route'));
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'prefix' => 'max:25',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|unique:users|email',
            'password' => 'required|max:255|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();

        $user->firstname = $request->firstname;
        $user->prefix = $request->prefix;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->available_hours = $request->available_hours;
//        $user->work_hours = $request->work_hours;
        $user->role_id = $request->input('role_id');
        $user->department_id = $request->input('department_id');
        $user->save();


        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'prefix' => 'max:25',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->firstname = $request->firstname;
        $user->prefix = $request->prefix;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->available_hours = $request->available_hours;
//        $user->work_hours = $request->work_hours;
        $user->role_id = $request->input('role_id');
        $user->department_id = $request->input('department_id');

        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }


}
