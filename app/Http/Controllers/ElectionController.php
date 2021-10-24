<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\Configuration\Position;
use App\Models\Student;
use App\Models\Candidate;
use App\Charts\OngoingElectionChart;
use Carbon\Carbon;
use Auth;

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
        $elections = Election::select('*');
        if(Auth::user()->hasrole('System Administrator')){
            $elections = $elections->withTrashed();
        }
        $data = [
            'elections' => $elections->get()
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
        
        $now = Carbon::now();
        $start_date = Carbon::parse($request->get('start_date'));
        $end_date = Carbon::parse($request->get('end_date'));
        $status = 'incoming';

        if($start_date->lt($now) && $end_date->gt($now)){
            $status = 'ongoing';
        }
        elseif($end_date->lt($now)){
            $status = 'ended';
        }

        $election = Election::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start_date' => Carbon::parse($request->get('start_date')),
            'end_date' => Carbon::parse($request->get('end_date')),
            'status' => $status
        ]);

        foreach($request->get('candidates') as $position => $candidates){
            foreach($candidates as $candidate){
                Candidate::create([
                    'student_id' => $candidate,
                    'election_id' => $election->id,
                    'position_id' => $position,
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
        $data = ([
			'positions' => Position::get(),
			'students' => Student::get(),
			'election' => $election
		]);

		return response()->json([
			'modal_content' => view('elections.edit', $data)->render()
		]);
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
        $request->validate([
			'title' => ['required', 'unique:elections,title,'.$election->id],
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);
        $now = Carbon::now();
        $start_date = Carbon::parse($request->get('start_date'));
        $end_date = Carbon::parse($request->get('end_date'));
        $status = 'incoming';

        if($start_date->lt($now) && $end_date->gt($now)){
            $status = 'ongoing';
        }
        elseif($end_date->lt($now)){
            $status = 'ended';
        }

        $election->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status
        ]);

        $selectedCandidatesIDs = [];

        foreach($request->get('candidates') as $position => $candidates){
            foreach($candidates as $candidate){
                $query = Candidate::where([
                    ['student_id', $candidate],
                    ['election_id', $election->id],
                    ['position_id', $position],
                ])->doesntExist();
                if($query){
                    Candidate::create([
                        'student_id' => $candidate,
                        'election_id' => $election->id,
                        'position_id' => $position,
                    ]);
                }
                $selectedCandidatesIDs[] = $candidate;
            }
        }
        $unselectedCandidatesID = Candidate::where([
            ['election_id', $election->id],
        ])->whereNotIn('student_id', $selectedCandidatesIDs)->delete();

        return redirect()->route('elections.index')->with('alert-success', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
	{
		if (request()->get('permanent')) {
			$election->forceDelete();
		}else{
			$election->delete();
		}
		return redirect()->route('elections.index')
						->with('alert-danger','Deleted');
	}

	public function restore($election)
	{
		$election = Election::withTrashed()->find($election);
		$election->restore();
		return redirect()->route('elections.index')
						->with('alert-success','Restored');
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

    public function updateStatus(Request $request, Election $election)
    {
        $now = Carbon::now();
        $start_date = Carbon::parse($election->start_date);
        $end_date = Carbon::parse($election->end_date);
        if($start_date <= $now && $end_date <= $now){
            $election->update(['status' => 'ongoing']);
        }
        elseif($now > $end_date){
            $election->update(['status' => 'ended']);
        }
    }

    public function results()
    {
        $electionChart = [[]];
        $elections = Election::where('status', 'ended')->orderBy('end_date','DESC')->get();
        foreach($elections as $election){
            if(isset($election->id)){
                foreach ($election->candidates->groupBy('position_id') as $position => $candidates) {
                    $electionChart[$election->id][$position] = new OngoingElectionChart;
                    $electionChart[$election->id][$position]->height(250);
                    $labels = [];
                    $votes = [];
                    foreach ($candidates as $candidate) {
                        $labels[] = $candidate->student->getStudentName($candidate->student_id);
                        $votes[] = $candidate->votes->count();
                    }
                    $electionChart[$election->id][$position]->labels($labels);
                    $electionChart[$election->id][$position]->dataset('votes', 'bar', $votes)->backgroundColor('#007bff')->color('#007bff');
                    $electionChart[$election->id][$position]->options([
                        'scales' => [
                            'yAxes' => [[
                                'ticks' => [
                                    'stepSize' => 1,
                                    // 'max' => 5,
                                    // 'max' => 0
                                ]
                            ]],
                            'xAxes' => [[
                                'gridLines' => [
                                    'display' => true
                                ]
                            ]]
                        ]
                    ]);
                }
            }
        }

        $data = [
            'electionChart' => $electionChart,
            'elections' => $elections,
        ];

        return view('elections.results', $data);
    }
}
