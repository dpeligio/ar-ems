@extends('layouts.adminlte')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v2</li>
                </ol>
            </div> --}}
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        {{-- <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Elections</span>
                        <span class="info-box-number">
                        10
                        <small>%</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Recent Election</h4>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <div class="row">
                            @isset($recentElection->id)
                                @foreach ($recentElection->candidates->groupBy('position_id') as $position => $candidates)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="card-title">{{ App\Models\Configuration\Position::find($position)->name }}</h3>
                                                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="position-relative mb-4">
                                                    {!! $recentElectionChart[$position]->container() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                            </div>
                            {{-- {!! $recentElectionChart->container() !!} --}}
                        </div>
                        {{-- <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This Week
                            </span>
                            <span>
                                <i class="fas fa-square text-gray"></i> Last Week
                            </span>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                    {!! $patientChart->container() !!}
                </div> --}}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"></div>
                </div>
            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')
<script src="{{ asset('AdminLTE-3.1.0/plugins/chart.js/Chart.min.js') }}"></script>
@isset($recentElection->id)
    @foreach ($recentElection->candidates->groupBy('position_id') as $position => $candidates)
    {!! $recentElectionChart[$position]->script() !!}
    @endforeach
@endisset
@endsection