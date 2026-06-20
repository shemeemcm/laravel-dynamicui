@php
    $stats = json_decode($block->content, true);
    if (!is_array($stats)) {
        // Fallback
        $stats = [
            ['number' => 'N/A', 'label' => $block->content]
        ];
    }
@endphp
<div class="container my-5">
    <div class="p-5 bg-dark text-white rounded-4 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid rgba(255,255,255,0.03);">
        <div class="position-absolute top-0 end-0 w-100 h-100 bg-gradient opacity-10" style="background: radial-gradient(circle, #10b981 0%, transparent 60%);"></div>
        <div class="text-center mb-5 position-relative z-1">
            <h3 class="fw-extrabold text-white mb-2">{{ $block->title }}</h3>
            <div class="mx-auto" style="width: 40px; height: 3px; background-color: #10b981; border-radius: 2px;"></div>
        </div>
        <div class="row g-4 text-center justify-content-center position-relative z-1">
            @foreach($stats as $stat)
                <div class="col-6 col-md-3">
                    <div class="p-3 bg-white bg-opacity-5 rounded-3 border border-secondary border-opacity-10 h-100 transition-all hover-lift">
                        <h2 class="display-5 fw-extrabold text-success mb-1" style="color: #10b981 !important;">{{ $stat['number'] ?? '0' }}</h2>
                        <p class="text-uppercase text-secondary fw-bold tracking-wider mb-0" style="font-size: 0.75rem; letter-spacing: 0.5px;">{{ $stat['label'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
