@extends('layouts.adminlte')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Elections</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 text-right">
                @can('elections.create')
                    <button class="btn btn-default" type="button" data-toggle="modal-ajax" data-href="{{ route('elections.create') }}" data-target="#createElection"><i class="fa fa-plus"></i> Add</button>
                @endcan
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>
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
                            <th>Status</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date of Election</th>
                            @role('System Administrator')
                            <th class="text-center">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elections as $election)
                        <tr @unlessrole('System Administrator') @can('elections.show') data-toggle="modal-ajax" data-target="#showElection" data-href="{{ route('elections.show', $election->id) }}"  @endcan @else class="{{ $election->trashed() ? 'table-danger' : '' }}" @endunlessrole>
                            @role('System Administrator')
                            <td>{{ $election->id }}</td>
                            @endrole
                            <td>
                                {{ $election->status }}
                            </td>
                            <td>{{ $election->title }}</td>
                            <td>{{ $election->description }}</td>
                            <td>
                                {{ date('F d, Y h:i A', strtotime($election->start_date)) }}
                                -
                                {{ date('F d, Y h:i A', strtotime($election->end_date)) }}
                            </td>
                            @role('System Administrator')
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#showElection" data-href="{{ route('elections.show',$election->id) }}"><i class="fad fa-file fa-lg"></i></a>
                                    @if ($election->trashed())
                                        <a class="text-success" href="javascript:void(0)" onclick="restoreFromTable(this)" data-href="{{ route('elections.restore', $election->id) }}"><i class="fad fa-download fa-lg"></i></a>
                                    @else
                                        <a class="text-danger" href="javascript:void(0)" onclick="deleteFromTable(this)" data-href="{{ route('elections.destroy', $election->id) }}"><i class="fad fa-trash-alt fa-lg"></i></a>
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
@endsection