<?php

namespace App\Http\Controllers;

use App\Continentes;
use Illuminate\Http\Request;

class ContinentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $continentes = Continentes::all();
        return response()->json($continentes);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Continentes  $continentes
     * @return \Illuminate\Http\Response
     */
    public function show(Continentes $continentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Continentes  $continentes
     * @return \Illuminate\Http\Response
     */
    public function edit(Continentes $continentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Continentes  $continentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Continentes $continentes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Continentes  $continentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Continentes $continentes)
    {
        //
    }
}
