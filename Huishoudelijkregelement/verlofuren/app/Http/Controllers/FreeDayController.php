<?php

namespace App\Http\Controllers;

use App\FreeDay;
use Illuminate\Http\Request;

class FreeDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freeday = FreeDay::all();
        return view('freeday.index', ['freeday' => $freeday]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasPermission('add_free_days')) {
            $freeday = new FreeDay();
            return view('freeday.create', compact('freeday'));
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
        $freeday = new FreeDay();
        $freeday->name = $request->name;
        $freeday->startdate = $request->startdate;
        $freeday->enddate = $request->enddate;
        $freeday->save();

        return redirect()->route('freeday.index');
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
        $freeday = FreeDay::findOrFail($id);
        return view('freeday.edit', compact('freeday', 'id'));
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
        $freeday = FreeDay::findOrFail($id);

        $freeday->name = $request->name;
        $freeday->startdate = $request->startdate;
        $freeday->enddate = $request->enddate;

        $freeday->save();

        return redirect()->route('freeday.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $freeday = FreeDay::findOrFail($id);
        $freeday->delete();
        return redirect()->back();
    }
}
