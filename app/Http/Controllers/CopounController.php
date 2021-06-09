<?php

namespace App\Http\Controllers;

use App\Models\Copoun;
use Illuminate\Http\Request;

class CopounController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Copoun::all();
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
     * @param  \App\Models\Copoun  $copoun
     * @return \Illuminate\Http\Response
     */
    public function show(Copoun $copoun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Copoun  $copoun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Copoun $copoun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Copoun  $copoun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Copoun $copoun)
    {
        //
    }
}
