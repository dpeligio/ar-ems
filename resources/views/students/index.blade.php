@extends('layouts.adminlte')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Positions</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 text-right">
                @can('students.create')
                    <button class="btn btn-default" type="button" data-toggle="modal-ajax" data-href="{{ route('students.create') }}" data-target="#createPosition"><i class="fa fa-plus"></i> Add</button>
                @endcan
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table id="datatable" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                @role('System Administrator')
                                <th>ID</th>
                                @endrole
                                <th>Name</th>
                                @role('System Administrator')
                                <th class="text-center">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr @unlessrole('System Administrator') @can('students.edit') data-toggle="modal-ajax" data-target="#editPosition" data-href="{{ route('students.edit', $student->id) }}"  @endcan @else class="{{ $student->trashed() ? 'table-danger' : '' }}" @endunlessrole>
                                @role('System Administrator')
                                <td>{{ $student->id }}</td>
                                @endrole
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                @role('System Administrator')
                                    <td class="text-center">
                                        {{-- <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#showUser" data-href="{{ route('students.show',$student->id) }}"><i class="fad fa-file-student fa-lg"></i></a> --}}
                                        <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#editUser" data-href="{{ route('students.edit',$student->id) }}"><i class="fad fa-edit fa-lg"></i></a>
                                        @if ($student->trashed())
                                            <a class="text-success" href="javascript:void(0)" onclick="restoreFromTable(this)" data-href="{{ route('students.restore', $student->id) }}"><i class="fad fa-download fa-lg"></i></a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)" onclick="deleteFromTable(this)" data-href="{{ route('students.destroy', $student->id) }}"><i class="fad fa-trash-alt fa-lg"></i></a>
                                        @endif
                                    </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection