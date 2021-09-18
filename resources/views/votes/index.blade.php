@extends('layouts.adminlte')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Votes</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 text-right">
                @can('votes.create')
                    <button class="btn btn-default" type="button" data-toggle="modal-ajax" data-href="{{ route('votes.create') }}" data-target="#createVote"><i class="fa fa-plus"></i> Add</button>
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
                    <table id="datatable" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                @role('System Administrator')
                                <th>ID</th>
                                @endrole
                                <th>Vote Number</th>
                                <th>Name</th>
                                @role('System Administrator')
                                <th class="text-center">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votes as $vote)
                            <tr @unlessrole('System Administrator') @can('votes.show') data-toggle="modal-ajax" data-target="#showVote" data-href="{{ route('votes.show', $vote->id) }}"  @endcan @else class="{{ $vote->trashed() ? 'table-danger' : '' }}" @endunlessrole>
                                @role('System Administrator')
                                <td>{{ $vote->id }}</td>
                                @endrole
                                <td>{{ $vote->vote_number }}</td>
                                <td>
                                    @if($vote->student)
                                    {{ $vote->student->getStudentName($vote->voter_id) }}
                                    @elseif($vote->faculty)
                                    {{ $vote->faculty->getFacultyName($vote->voter_id) }}
                                    @endif
                                </td>
                                @role('System Administrator')
                                    <td class="text-center">
                                        <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#showVote" data-href="{{ route('votes.show',$vote->id) }}"><i class="fad fa-file fa-lg"></i></a>
                                        {{-- <a href="javascript:void(0)" data-toggle="modal-ajax" data-target="#editVote" data-href="{{ route('votes.edit',$vote->id) }}"><i class="fad fa-edit fa-lg"></i></a> --}}
                                        @if ($vote->trashed())
                                            <a class="text-success" href="javascript:void(0)" onclick="restoreFromTable(this)" data-href="{{ route('votes.restore', $vote->id) }}"><i class="fad fa-download fa-lg"></i></a>
                                        @else
                                            <a class="text-danger" href="javascript:void(0)" onclick="deleteFromTable(this)" data-href="{{ route('votes.destroy', $vote->id) }}"><i class="fad fa-trash-alt fa-lg"></i></a>
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