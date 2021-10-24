@extends('layouts.adminlte')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sections</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 text-right">
                @can('sections.create')
                    <button class="btn btn-default" type="button" data-toggle="modal-ajax" data-href="{{ route('sections.create') }}" data-target="#createSection"><i class="fa fa-plus"></i> Add</button>
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
                    <table id="datatable" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                @role('System Administrator')
                                <th>ID</th>
                                @endrole
                                <th>Year Level</th>
                                <th>Name</th>
                                @role('System Administrator')
                                <th class="text-center">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                            <tr @unlessrole('System Administrator') @can('sections.edit') data-toggle="modal-ajax" data-target="#editSection" data-href="{{ route('sections.edit', $section->id) }}"  @endcan @else class="{{ $section->trashed() ? 'table-danger' : '' }}" @endunlessrole>
                                @role('System Administrator')
                                <td>{{ $section->id }}</td>
                                @endrole
                                <td>{{ $section->grade_level }}</td>
                                <td>{{ $section->name }}</td>
                                @role('System Administrator')
                                    <td class="text-center">
                                        <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#showSection" data-href="{{ route('sections.show',$section->id) }}"><i class="fad fa-file fa-lg"></i></a>
                                        {{-- <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#editSection" data-href="{{ route('sections.edit',$section->id) }}"><i class="fad fa-edit fa-lg"></i></a> --}}
                                        @if ($section->trashed())
                                            <a class="text-success" href="javascript:void(0)" onclick="restoreFromTable(this)" data-href="{{ route('sections.restore', $section->id) }}"><i class="fad fa-download fa-lg"></i></a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)" onclick="deleteFromTable(this)" data-href="{{ route('sections.destroy', $section->id) }}"><i class="fad fa-trash-alt fa-lg"></i></a>
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