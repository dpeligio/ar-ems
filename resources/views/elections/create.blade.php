<form action="{{ route('elections.store') }}" method="POST" autocomplete="off">
	@csrf
	<div class="modal fade" id="createElection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Election</h5>
                    <button type="button" class="close" data-dismiss="modal-ajax" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
							<label>Title:</label>
							<input class="form-control" type="text" name="title">
						</div>
						<div class="form-group col-md-12">
                            <label>Description:</label>
                            <textarea name="description" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Date of Election:</label>
                            <div class="input-group datetimepicker" id="startDate" data-target-input="nearest">
                                <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#startDate" data-toggle="datetimepicker"/>
                                <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <legend>Candidates:</legend>
                        @foreach ($positions as $position)
                        <div class="form-group col-md-12">
							<label>{{ $position->name }}:</label>
							<select class="form-control select2" multiple  name="candidates[{{ $position->id}}][]" style="width: 100%">
								@foreach ($students as $student)
									<option value="{{ $student->id }}">{{ $student->getStudentName($student->id) }}</option>
								@endforeach
							</select>
						</div>
                        @endforeach
						{{-- <div class="form-group col-md-6">
							<label>Request References:</label>
							<select class="form-control select2" multiple  name="request_reference[]" style="width: 100%">
								@foreach ($references as $reference)
									<option value="{{ $reference->id }}">{{ $reference->name }} @if($reference->description!=null){{ '['.$reference->description.']' }}@endif</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Result References:</label>
							<select class="form-control select2" multiple  name="reference[]" style="width: 100%">
								@foreach ($references as $reference)
									<option value="{{ $reference->id }}">{{ $reference->name }} @if($reference->description!=null){{ '['.$reference->description.']' }}@endif</option>
								@endforeach
							</select>
						</div> --}}
					</div>
				</div>
				<div class="modal-footer">
                    <button type="submit" class="btn btn-default text-success"><i class="fad fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
