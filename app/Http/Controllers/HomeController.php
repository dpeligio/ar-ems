<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Configuration\Position;
use App\Charts\OngoingElectionChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ongoingElectionChart = [];
        $ongoingElection = Election::where('status', 'ongoing')->orderBy('start_date','DESC')->first();
        if(isset($ongoingElection->id)){
            foreach ($ongoingElection->candidates->groupBy('position_id') as $position => $candidates) {
                $ongoingElectionChart[$position] = new OngoingElectionChart;
                $ongoingElectionChart[$position]->height(250);
                $labels = [];
                $votes = [];
                foreach ($candidates as $candidate) {
                    $labels[] = $candidate->student->getStudentName($candidate->student_id);
                    $votes[] = $candidate->votes->count();
                }
                $ongoingElectionChart[$position]->labels($labels);
                $ongoingElectionChart[$position]->dataset('votes', 'bar', $votes)->backgroundColor('#007bff')->color('#007bff');
                $ongoingElectionChart[$position]->options([
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

        $data = [
            'ongoingElectionChart' => $ongoingElectionChart,
            'ongoingElection' => $ongoingElection,
        ];

        return view('dashboard', $data);
    }
}
