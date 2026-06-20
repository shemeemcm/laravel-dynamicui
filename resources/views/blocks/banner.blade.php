<div class="container my-5">
    <div class="p-5 text-center bg-dark rounded-4 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); min-height: 350px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255, 255, 255, 0.05);">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient opacity-10" style="background: radial-gradient(circle, #3b82f6 0%, transparent 70%);"></div>
        <div class="position-relative z-1 py-4 w-100">
            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3 text-uppercase tracking-wider fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">FEATURED BLOCK</span>
            <h1 class="display-4 fw-black text-white mb-3" style="letter-spacing: -1px; font-weight: 800;">{{ $block->title }}</h1>
            <p class="col-lg-8 mx-auto fs-5 text-secondary mb-4">
                {{ $block->content }}
            </p>
            <div class="d-inline-flex gap-3 justify-content-center">
                <a href="#features" class="btn btn-primary btn-lg px-4 py-3 rounded-3 fw-semibold shadow transition-all">Get Started <i class="bi bi-arrow-right ms-2"></i></a>
                <a href="#faq" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-3 fw-semibold transition-all">Learn More</a>
            </div>
        </div>
    </div>
</div>
