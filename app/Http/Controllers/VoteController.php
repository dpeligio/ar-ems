<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\VoteData;
use Auth;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'votes' => Vote::get()
        ];

        return view('votes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentVotes = Vote::where([
            'id' => Auth::user()->id
        ])->select('election_id');

        $data = ([
			'elections' => Election::whereIn('id', $studentVotes)->get()
		]);

		return response()->json([
			'modal_content' => view('votes.create', $data)->render()
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
            'election_id' => 'required'
        ]);

        $vote = Vote::create([
            'vote_number' => time(),
            'election_id' => $request->get('election_id'),
            'voter_id' => Auth::user()->id,
        ]);

        foreach ($request->get('position') as $position => $candidate) {
            VoteData::create([
                'vote_id' => $vote->id,
                'position_id' => $position,
                'candidate_id' => $candidate,
            ]);
        }
        
        return back()->with('alert-success', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
    
}
