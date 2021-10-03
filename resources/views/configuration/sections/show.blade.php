<div class="modal fade" id="showSection" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $section_show->name }}</h5>
                <button type="button" class="close" data-dismiss="modal-ajax" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label>Year Level:</label> {{ $section_show->year_level }}
                        <br>
                        <label>Name:</label> {{ $section_show->name }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <legend>Students: {{ $section_show->students->count() }}</legend>
                        <table class="table table-sm table-bordered" id="sectionStudentDatatable">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($section_show->students as $student)
                                <tr>
                                    <td>
                                        {{ $student->student->student_id }}
                                    </td>
                                    <td>
                                        {{ $student->student->getStudentName($student->student_id) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="table-danger text-danger">*** EMPTY ***</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#sectionStudentDatatable').dataTable();
    })
</script>