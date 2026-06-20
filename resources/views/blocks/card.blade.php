@php
    $cards = json_decode($block->content, true);
    if (!is_array($cards)) {
        // Fallback for plain text content
        $cards = [
            ['title' => 'Sample Card 1', 'text' => $block->content, 'icon' => 'bi-app-indicator'],
        ];
    }
@endphp
<div class="container my-5" id="features">
    <div class="text-center mb-5">
        <h2 class="fw-extrabold text-dark display-6 mb-2">{{ $block->title }}</h2>
        <div class="mx-auto" style="width: 50px; height: 4px; background-color: #3b82f6; border-radius: 2px;"></div>
    </div>
    <div class="row g-4 justify-content-center">
        @foreach($cards as $card)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 transition-all hover-shadow-md position-relative" style="background-color: #ffffff; border: 1px solid rgba(0,0,0,0.03) !important;">
                    <div class="card-body p-0">
                        <div class="d-inline-flex align-items-center justify-content-center text-primary bg-primary bg-opacity-10 rounded-3 p-3 mb-4" style="width: 54px; height: 54px;">
                            <i class="bi {{ $card['icon'] ?? 'bi-box-seam' }} fs-4"></i>
                        </div>
                        <h4 class="card-title fw-bold text-slate-800 mb-3" style="font-size: 1.25rem;">{{ $card['title'] ?? 'Feature' }}</h4>
                        <p class="card-text text-secondary mb-0" style="line-height: 1.6;">{{ $card['text'] ?? '' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
