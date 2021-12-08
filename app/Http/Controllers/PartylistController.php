<?php

namespace App\Http\Controllers;

use App\Models\Partylist;
use Illuminate\Http\Request;

class PartylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'partylists' => Partylist::get()
        ];
        return view('partylists.index', $data);
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
     * @param  \App\Models\Partylist  $partylist
     * @return \Illuminate\Http\Response
     */
    public function show(Partylist $partylist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partylist  $partylist
     * @return \Illuminate\Http\Response
     */
    public function edit(Partylist $partylist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partylist  $partylist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partylist $partylist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partylist  $partylist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partylist $partylist)
    {
        //
    }
}
