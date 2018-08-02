<?php

namespace App\Http\Controllers;

use App\BusInfo;
use Illuminate\Http\Request;

class BusInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin', ['except' => ['index','show'] ]);
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return(view("businfo.index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusInfo $busInfo
     * @return \Illuminate\Http\Response
     */
    public function show(BusInfo $busInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusInfo $busInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(BusInfo $busInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\BusInfo $busInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusInfo $busInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusInfo $busInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusInfo $busInfo)
    {
        //
    }
}
