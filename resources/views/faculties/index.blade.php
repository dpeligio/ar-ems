@extends('layouts.adminlte')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Faculties</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 text-right">
                @can('faculties.create')
                    <button class="btn btn-default" type="button" data-toggle="modal-ajax" data-href="{{ route('faculties.create') }}" data-target="#createFaculty"><i class="fa fa-plus"></i> Add</button>
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
                <div class="col">
                    <table id="datatable" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                @role('System Administrator')
                                <th>ID</th>
                                @endrole
                                <th>Account Status</th>
                                <th>Faculty ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                @role('System Administrator')
                                <th class="text-center">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faculties as $faculty)
                            <tr @unlessrole('System Administrator') @can('faculties.show') data-toggle="modal-ajax" data-target="#showFaculty" data-href="{{ route('faculties.show', $faculty->id) }}"  @endcan @else class="{{ $faculty->trashed() ? 'table-danger' : '' }}" @endunlessrole>
                                @role('System Administrator')
                                <td>{{ $faculty->id }}</td>
                                @endrole
                                <td>
                                    @isset ($faculty->user)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-danger">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $faculty->faculty_id }}</td>
                                <td>{{ $faculty->first_name }}</td>
                                <td>{{ $faculty->middle_name }}</td>
                                <td>{{ $faculty->last_name }}</td>
                                @role('System Administrator')
                                    <td class="text-center">
                                        <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#showFaculty" data-href="{{ route('faculties.show',$faculty->id) }}"><i class="fad fa-file fa-lg"></i></a>
                                        {{-- <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#editStudent" data-href="{{ route('faculties.edit',$faculty->id) }}"><i class="fad fa-edit fa-lg"></i></a> --}}
                                        @if ($faculty->trashed())
                                            <a class="text-success" href="javascript:void(0)" onclick="restoreFromTable(this)" data-href="{{ route('faculties.restore', $faculty->id) }}"><i class="fad fa-download fa-lg"></i></a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)" onclick="deleteFromTable(this)" data-href="{{ route('faculties.destroy', $faculty->id) }}"><i class="fad fa-trash-alt fa-lg"></i></a>
                                        @endif
                                    </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(config('app.env') == 'local')
                    @role('System Administrator')
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                Insert Dummy Facultys
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('dummy_identity.insert_faculty') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <hr>
                                    <div class="form-group">
                                        <label>Number of Facultys: </label>
                                        <input class="form-control" type="number" name="number" max="15000" min="1" value="1">
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-danger">Submit</button>					
                                </form>
                            </div>
                        </div>
                    </div>	
                    @endrole
                @endif
            </div>
        </div>
    </section>
</div>
@endsection