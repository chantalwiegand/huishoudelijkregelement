<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Absence;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absence2 =  Absence::all();
        $user = Auth::user();
        $absence = DB::table('absence')
            ->join('users', 'absence.user_id', '=', 'users.id')
            ->where('absence.user_id', '=', $user->id )
            ->orderByDesc('absence.created_at')
            ->take(5)
            ->get();
        return view('home', ['absence' => $absence, 'user' => $user, 'absence2' => $absence2 ]);
    }
}
