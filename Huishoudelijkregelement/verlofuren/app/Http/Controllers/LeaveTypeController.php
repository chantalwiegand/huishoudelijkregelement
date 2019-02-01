<?php

namespace App\Http\Controllers;

use App\LeaveType;
use Validator;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leavetype = LeaveType::all();
        return view('leavetype.index', ['leavetype'=>$leavetype]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasPermission('add_leave_type')) {
            $route = route('leavetype.create');
            $leavetype = new LeaveType();
            return view('leavetype.create', compact('leavetype', 'route'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $leavetype = new LeaveType();
        $leavetype->name = $request->name;
        $leavetype->description = $request->description;
        $leavetype->save();

        return redirect()->route('leavetype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leavetype = LeaveType::findOrFail($id);
        return view('leavetype.edit', compact('leavetype', 'id'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'description' => 'max:255',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $leavetype = LeaveType::findOrFail($id);

        $leavetype->name = $request->name;
        $leavetype->description = $request->description;
        $leavetype->save();

        return redirect()->route('leavetype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->delete();
        return redirect()->back();
    }
}
