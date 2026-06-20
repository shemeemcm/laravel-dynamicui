@php
    $items = array_filter(array_map('trim', explode(',', $block->content)));
@endphp
<div class="container my-5" id="faq">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="p-5 bg-white border border-light-subtle rounded-4 shadow-sm">
                <h3 class="fw-extrabold text-slate-800 mb-4 text-center">{{ $block->title }}</h3>
                <div class="list-group list-group-flush">
                    @foreach($items as $item)
                        @if(!empty($item))
                            <div class="list-group-item d-flex align-items-start border-0 py-3 px-0">
                                <div class="text-success me-3 mt-1">
                                    <i class="bi bi-check-circle-fill fs-5"></i>
                                </div>
                                <div>
                                    <span class="fs-6 text-dark fw-medium">{{ $item }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
