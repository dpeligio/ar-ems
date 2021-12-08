<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Task;
use App\Models\Votes;
use App\Models\User;
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
        $students = Student::get()->count();
        $faculties = Faculty::get()->count();
        $taskDone = Task::where('is_done', 1)->get()->count();
        $tasks = Task::get()->count();
        $users = User::get()->count();

        $ongoingElectionChart = [];
        $ongoingElection = Election::where('status', 'ongoing')->orderBy('start_date','DESC')->first();
        if(isset($ongoingElection->id)){
            foreach ($ongoingElection->candidates->groupBy('position_id') as $position => $candidates) {
                $ongoingElectionChart[$position] = new OngoingElectionChart;
                $ongoingElectionChart[$position]->height(250);
                $labels = [];
                $votes = [];
                $ongoingElectionChart[$position]->labels(['votes']);
                foreach ($candidates as $candidate) {
                    $labels[] = $candidate->student->fullname('');
                    $votes[$candidate->id] = $candidate->votes->count();
                }
                foreach ($candidates as $candidate) {
                    $legend = $candidate->student->fullname('').($candidate->partylist->name ? ' ('.$candidate->partylist->name.')' : '');
                    $ongoingElectionChart[$position]->dataset($legend, 'bar', [$votes[$candidate->id]])->backgroundColor(($candidate->partylist->color ?? '#28a745'))->color(($candidate->partylist->color ?? '#28a745'));
                }
                
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
            'taskDone' => $taskDone,
            'tasks' => $tasks,
            'faculties' => $faculties,
            'students' => $students,
            'users' => $users,
        ];

        return view('dashboard', $data);
    }
}
