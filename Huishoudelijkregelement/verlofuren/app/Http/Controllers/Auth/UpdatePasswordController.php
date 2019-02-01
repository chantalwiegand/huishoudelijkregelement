<?php
/**
 * Created by PhpStorm.
 * User: chant
 * Date: 19-9-2018
 * Time: 08:16
 */



namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{

    /*
     * Ensure the user is signed in to access this page
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Show the form to change the user password
     */
    public function index() {
        return view('user.changePassword');
    }

    /*
     * Update the password for the user
     */
    public function update(Request $request) {

        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();


            return redirect()->back()->withErrors(['Your password has been updated']);
        } else {

            $request->session()->flash('failure', 'Your password has not been changed.');

            return back();
        }

    }

}