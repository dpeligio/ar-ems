<input type="hidden" name="election_id" value="{{ $election->id }}">
<div class="row">
    <div class="col-md-6">
        <label>Title: </label>
        {{ $election->title }}
        <br>
        <label>Description: </label>
        {{ $election->description }}
        <br>
        <label>Election Date: </label>
        {{ $election->election_date }}
    </div>
    <div class="col-md-6">
    @foreach ($election->candidates->groupBy('position_id') as $position => $candidates)
        <legend>{{ App\Models\Configuration\Position::find($position)->name }}</legend>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                <tr>
                    <td>
                        {{ $candidate->student->getStudentName($candidate->student_id) }}
                    </td>
                    <td class="text-center">
                        <div class="radio">
                            <div class="custom-control custom-radio">
                                <input required type="radio" class="custom-control-input" name="position[{{ $position }}]" value="{{ $candidate->student_id }}" id="candidate_{{ $candidate->student_id }}">
                                <label class="custom-control-label" for="candidate_{{ $candidate->student_id }}"></label>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</div>
<hr>
    