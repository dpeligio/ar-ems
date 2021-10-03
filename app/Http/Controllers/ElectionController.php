<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\Configuration\Position;
use App\Models\Student;
use App\Models\Candidate;
use Carbon\Carbon;

class ElectionController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:elections.index', ['only' => ['index']]);
		$this->middleware('permission:elections.create', ['only' => ['create','store']]);
		$this->middleware('permission:elections.show', ['only' => ['show']]);
		$this->middleware('permission:elections.edit', ['only' => ['edit','update']]);
		$this->middleware('permission:elections.destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'elections' => Election::get()
        ];

        return view('elections.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ([
			'positions' => Position::get(),
			'students' => Student::get()
		]);
		/* if(!Auth::user()->hasrole('System Administrator')){
			$data = ([
				'faculty' => $faculty,
			]);
		} */

		return response()->json([
			'modal_content' => view('elections.create', $data)->render()
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
			'title' => ['required', 'unique:elections,title'],
            'start_date' => 'required',
            'description' => 'required',
        ]);

        $election = Election::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start_date' => Carbon::parse($request->get('start_date')),
            'end_date' => Carbon::parse($request->get('end_date')),
            'status' => "1"
        ]);

        foreach($request->get('candidates') as $position => $candidates){
            foreach($candidates as $candidate){
                Candidate::create([
                    'student_id' => $candidate,
                    'election_id' => $election->id,
                    'position_id' => $position
                ]);
            }
        }

        return back()->with('alert-success', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        $data = [
            'election_show' => $election
        ];
        return response()->json([
			'modal_content' => view('elections.show', $data)->render()
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
    {
        //
    }

    public function getElectionData(Request $request, Election $election)
    {
        $data = [
            'election' => $election
        ];
        return response()->json([
			'election_data' => view('votes.vote', $data)->render()
		]);
    }
}
