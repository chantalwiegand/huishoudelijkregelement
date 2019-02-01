<?php

namespace App\Http\Controllers;

use App\Absence;

use App\Mail\LeaveAccepted;
use App\Mail\LeaveDeclined;
use App\Mail\RequestLeave;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;



class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $employee = $request->employee;
        $year = $request->year;
        $status = $request->status;

        $absence =  Absence::when($employee, function($q) use ($employee){
            return $q->where('user_id', $employee);
        })->when($year, function($q) use ($year){
            return $q->where('start_date', 'like',  '%' . $year . '%');
        })->when($status, function ($q) use ($status) {
            return $q->where('status', 'like', $status);
        })->Paginate(20);


//        $events = Absence::get()->groupBy(function($d) {
//            return Carbon::parse($d->start_date)->format('F, Y');
//        });

//        dd($events);
        return view('absence.index', ['absence' => $absence, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $absence = new Absence();
        return view('absence.request', ['user' => $user], compact('absence', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absence = new Absence();
        $user = Auth::user();
        $absence->hoursofleave = $request->hoursofleave;
        $absence->user_id = $user->id;
        $absence->start_date = $request->start_date;
        $absence->end_date = $request->end_date;
        $absence->leavetype_id = $request->input('leavetype_id');

        $absence->save();
        $user->save();

        $all_users = User::all()->where('role_id', '4')->where('department_id', '=', $user->department_id);
        foreach ($all_users as $data) {
            if(env('APP_DEBUG')){
                $email = 'chantalesmee@live.nl';
            } else {
                $email = $data->email;
            }
            Mail::to($email)->send(new RequestLeave($absence));
        }
        return redirect()->back()->withErrors([__('absence.Succes')]);
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
        if (\Auth::user()->hasPermission('approve_and_decline')) {
            $absence = Absence::findOrFail($id);
            if (isset($_POST['approved'])) {
                $absence->status = 'Approved';
                $absence->user->used_hours += $absence->hoursofleave;
                $absence->user->available_hours = $absence->user->available_hours - $absence->hoursofleave;
                Mail::to($absence->user->email)->send(new LeaveAccepted());
            } elseif (isset($_POST['declined'])) {
                $absence->status = 'Declined';
                // decline reason is $request->decline_reason;

                Mail::to($absence->user->email)->send(new LeaveDeclined($request->decline_reason));

            }
            $absence->save();

            $absence->user->save();

        }


        return redirect()->back();
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
        //
    }

    public function showAbsence()
    {
        $user = Auth::user();
        $absence = DB::table('absence')
            ->join('users', 'absence.user_id', '=', 'users.id')->get();
        return view('absence.show', ['absence' => $absence, 'user' => $user]);
    }

    public function allRequests(Request $request)
    {
        $user = Auth::user();

        $year = $request->year;
        $status = $request->status;

        $absence =  Absence::when($year, function($q) use ($year){
            return $q->where('start_date', 'like',  '%' . $year . '%');
        })->when($status, function ($q) use ($status) {
            return $q->where('status', 'like', $status);
        })->paginate(10000);
        return view('absence.all', ['absence' => $absence, 'user' => $user]);
    }




}
