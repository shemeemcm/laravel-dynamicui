@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-extrabold text-slate-800">Dashboard</h2>
            <p class="text-secondary">Quick overview of your application stats and configurations.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 hover-lift h-100 border-start border-primary border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase text-secondary fw-bold small mb-1">Total UI Blocks</h6>
                        <h2 class="fw-bold mb-0 text-slate-800">{{ $stats['total'] }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <i class="bi bi-grid-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 hover-lift h-100 border-start border-success border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase text-secondary fw-bold small mb-1">Active Blocks</h6>
                        <h2 class="fw-bold mb-0 text-success">{{ $stats['active'] }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-eye-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 hover-lift h-100 border-start border-danger border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase text-secondary fw-bold small mb-1">Inactive Blocks</h6>
                        <h2 class="fw-bold mb-0 text-danger">{{ $stats['inactive'] }}</h2>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3">
                        <i class="bi bi-eye-slash-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="fw-bold text-slate-800 mb-3"><i class="bi bi-lightning-charge me-2 text-primary"></i>Quick Actions</h5>
                <p class="text-secondary small">Perform basic management tasks in one click.</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-primary text-start p-3 d-flex justify-content-between align-items-center rounded-3">
                        <span><i class="bi bi-list-task me-2"></i> View UI Blocks List</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="{{ route('admin.blocks.create') }}" class="btn btn-outline-success text-start p-3 d-flex justify-content-between align-items-center rounded-3">
                        <span><i class="bi bi-plus-square-fill me-2"></i> Create New UI Block</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary text-start p-3 d-flex justify-content-between align-items-center rounded-3">
                        <span><i class="bi bi-globe2 me-2"></i> Visit Landing Page</span>
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
