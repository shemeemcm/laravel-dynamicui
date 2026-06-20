@extends('layouts.admin')

@section('styles')
<style>
    .drag-handle {
        cursor: move;
        color: #94a3b8;
    }
    .sortable-ghost {
        background-color: #f1f5f9;
        opacity: 0.8;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-extrabold text-slate-800 m-0">UI Blocks</h2>
            <p class="text-secondary m-0">Manage layout blocks, reorder them, or toggle status dynamically.</p>
        </div>
        <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary rounded-3">
            <i class="bi bi-plus-lg me-1"></i> Add Block
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="blocks-table">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">Order</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th width="150" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-blocks">
                        @forelse($blocks as $block)
                            <tr data-id="{{ $block->id }}">
                                <td class="text-center">
                                    <div class="drag-handle">
                                        <i class="bi bi-grip-vertical fs-5"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $block->title }}</div>
                                    <span class="text-muted small">Display Order: {{ $block->display_order }}</span>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match($block->type) {
                                            'banner' => 'bg-primary-subtle text-primary',
                                            'card' => 'bg-success-subtle text-success',
                                            'list' => 'bg-warning-subtle text-warning-emphasis',
                                            'stats' => 'bg-info-subtle text-info-emphasis',
                                            default => 'bg-secondary-subtle text-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} text-uppercase px-2.5 py-1.5 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                        {{ $block->type }}
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input status-toggle" type="checkbox" role="switch" 
                                               data-id="{{ $block->id }}" {{ $block->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.blocks.edit', $block->id) }}" class="btn btn-sm btn-outline-secondary rounded-2 me-1" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger rounded-2 delete-btn" data-id="{{ $block->id }}" title="Delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary">
                                    <i class="bi bi-inbox display-6 mb-3 d-block text-muted"></i>
                                    No blocks found. Click "Add Block" to create your first layout block.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        const table = $('#blocks-table').DataTable({
            responsive: true,
            ordering: false, // Disable default sorting to preserve custom sort order
            lengthMenu: [10, 25, 50, 100],
            pageLength: 50,
            columnDefs: [
                { targets: [0, 3, 4], orderable: false }
            ]
        });

        // Initialize SortableJS
        const el = document.getElementById('sortable-blocks');
        if (el) {
            new Sortable(el, {
                handle: '.drag-handle',
                ghostClass: 'sortable-ghost',
                animation: 150,
                onEnd: function() {
                    const order = [];
                    $('#sortable-blocks tr').each(function() {
                        const id = $(this).data('id');
                        if (id) {
                            order.push(id);
                        }
                    });

                    // Send AJAX post request to save order
                    $.ajax({
                        url: "{{ route('admin.blocks.update-order') }}",
                        method: "POST",
                        data: { order: order },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Reordered!',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        },
                        error: function(err) {
                            console.error(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to update order. Please try again.'
                            });
                        }
                    });
                }
            });
        }

        // Toggle Status via AJAX
        $('.status-toggle').on('change', function() {
            const blockId = $(this).data('id');
            const isChecked = $(this).is(':checked');
            const url = `/admin/blocks/${blockId}/toggle-status`;

            $.ajax({
                url: url,
                method: "POST",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function(err) {
                    console.error(err);
                    // Revert the check state on failure
                    $(this).prop('checked', !isChecked);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update status. Please try again.'
                    });
                }
            });
        });

        // Delete Block via AJAX
        $('.delete-btn').on('click', function() {
            const blockId = $(this).data('id');
            const row = $(this).closest('tr');
            const url = `/admin/blocks/${blockId}`;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "DELETE",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                // Fade out and remove row
                                row.fadeOut(400, function() {
                                    table.row(row).remove().draw(false);
                                });
                            }
                        },
                        error: function(err) {
                            console.error(err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete block. Please try again.'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
