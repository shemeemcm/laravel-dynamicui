@extends('layouts.client')

@section('content')
    @if($blocks->isEmpty())
        <div class="container my-5 py-5 text-center">
            <div class="p-5 bg-white rounded-4 shadow-sm border border-light-subtle max-width-md mx-auto" style="max-width: 600px;">
                <div class="d-inline-flex align-items-center justify-content-center text-secondary bg-light rounded-circle p-4 mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-layout-text-sidebar-reverse fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark">No Content Available</h3>
                <p class="text-secondary mb-4">No active layout blocks were found in the database. Please log in as an Admin to add and enable blocks.</p>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.blocks.index') }}" class="btn btn-primary rounded-pill px-4">Manage Blocks</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Admin Login</a>
                @endauth
            </div>
        </div>
    @else
        @foreach($blocks as $block)
            @include('blocks.' . $block->type, ['block' => $block])
        @endforeach
    @endif
@endsection
