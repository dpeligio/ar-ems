<form action="{{ route('elections.store') }}" method="POST" autocomplete="off">
	@csrf
	<div class="modal fade" id="createElection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Election</h5>
                    <button type="button" class="close" data-dismiss="modal-ajax" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <legend>Election Info:</legend>
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" type="text" name="title" required>
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea name="description" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Election Start Date:</label>
                                <div class="input-group datetimepicker" id="startDate" data-target-input="nearest">
                                    <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#startDate" data-toggle="datetimepicker" required/>
                                    <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Election End Date:</label>
                                <div class="input-group datetimepicker" id="endDate" data-target-input="nearest">
                                    <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#endDate" data-toggle="datetimepicker" required/>
                                    <div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <legend>Candidates:</legend>
                            @foreach ($positions as $position)
                            <div class="form-group col-md-12">
                                <label>{{ $position->name }}:</label>
                                <select class="form-control select2" multiple  name="candidates[{{ $position->id}}][]" style="width: 100%" required>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->getStudentName($student->id) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
					</div>
				</div>
				<div class="modal-footer">
                    <button type="submit" class="btn btn-default text-success"><i class="fad fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
