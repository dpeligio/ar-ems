<form action="{{ route('sections.update', $section->id) }}" method="POST" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editSection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sections</h5>
                    <button type="button" class="close" data-dismiss="modal-ajax" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
						        <label for="name">Year Level:</label>
						        <input id="name" type="text" class="form-control{{ $errors->has('year_level') ? ' is-invalid' : '' }}" name="year_level" value="{{ old('year_level') ?? $section->year_level }}">
						        @if ($errors->has('year_level'))
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $errors->first('year_level') }}</strong>
						            </span>
						        @endif
                            </div>
                            <div class="form-group">
						        <label for="name">Name:</label>
						        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $section->name }}">
						        @if ($errors->has('name'))
						            <span class="invalid-feedback" role="alert">
						                <strong>{{ $errors->first('name') }}</strong>
						            </span>
						        @endif
						    </div>
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