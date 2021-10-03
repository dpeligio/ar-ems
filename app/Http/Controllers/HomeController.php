<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Configuration\Position;
use App\Charts\RecentElectionChart;

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
        // $ongoing_election = Election::whereDate('election_date_start');
        $recentElectionChart = [];
        // $votes = [];
        $recentElection = Election::orderBy('start_date','DESC')->first();
        // if($recentElection->count() == 1)
        if(isset($recentElection->id)){
            foreach ($recentElection->candidates->groupBy('position_id') as $position => $candidates) {
                $recentElectionChart[$position] = new RecentElectionChart;
                $recentElectionChart[$position]->height(250);
                $labels = [];
                $votes = [];
                foreach ($candidates as $candidate) {
                    $labels[] = $candidate->student->getStudentName($candidate->student_id);
                    $votes[] = $candidate->votes->count();
                }
                $recentElectionChart[$position]->labels($labels);
                $recentElectionChart[$position]->dataset('votes', 'bar', $votes)->backgroundColor('#007bff')->color('#007bff');
                $recentElectionChart[$position]->options([
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
            'recentElectionChart' => $recentElectionChart,
            'recentElection' => $recentElection,
        ];

        return view('dashboard', $data);
        /* }else{
            return view('dashboard');
        } */
    }
}
