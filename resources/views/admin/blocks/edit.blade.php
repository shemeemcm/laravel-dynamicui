@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0" style="max-width: 900px;">
    <div class="mb-4">
        <a href="{{ route('admin.blocks.index') }}" class="btn btn-link p-0 text-decoration-none text-secondary">
            <i class="bi bi-arrow-left"></i> Back to Blocks List
        </a>
        <h2 class="fw-extrabold text-slate-800 mt-2">Edit UI Block</h2>
        <p class="text-secondary">Modify block settings, type, content, or status.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please correct the following errors:</div>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.blocks.update', $block->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Block Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $block->title) }}" placeholder="e.g. Features that Empower You" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="mb-3">
                    <label for="type" class="form-label fw-semibold">Block Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="" disabled>Select block type...</option>
                        <option value="banner" {{ old('type', $block->type) == 'banner' ? 'selected' : '' }}>Banner (Hero Section)</option>
                        <option value="card" {{ old('type', $block->type) == 'card' ? 'selected' : '' }}>Card (Grid of Cards)</option>
                        <option value="list" {{ old('type', $block->type) == 'list' ? 'selected' : '' }}>List (Comma Separated Items)</option>
                        <option value="stats" {{ old('type', $block->type) == 'stats' ? 'selected' : '' }}>Stats (Statistic Grid)</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content Guide Card -->
                <div class="card bg-light border border-light-subtle mb-3 d-none" id="content-guide">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-2" id="guide-title">Formatting Guide</h6>
                        <p class="text-secondary small mb-2" id="guide-description">Select a block type to see how the content should be structured.</p>
                        <div class="position-relative">
                            <pre class="bg-dark text-white p-3 rounded mb-0 small" id="guide-template" style="overflow-x: auto;"></pre>
                            <button type="button" class="btn btn-sm btn-outline-light position-absolute top-0 end-0 m-2" id="use-template-btn">Reset to Template</button>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" placeholder="Enter content or structure here..." required>{{ old('content', $block->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Display Order -->
                <div class="mb-3">
                    <label for="display_order" class="form-label fw-semibold">Display Order</label>
                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="display_order" name="display_order" value="{{ old('display_order', $block->display_order) }}" placeholder="e.g. 1">
                    <span class="text-muted small">Lower numbers appear first.</span>
                    @error('display_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" {{ old('status', $block->status ? '1' : '0') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="status">Active (Visible on Homepage)</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-3 px-4">Update Block</button>
                    <a href="{{ route('admin.blocks.index') }}" class="btn btn-outline-secondary rounded-3 px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const guides = {
            banner: {
                title: "Banner Block Content",
                description: "Write raw description text for the large hero banner.",
                template: "Unlock unprecedented productivity and design excellence. Build dynamic interfaces, manage components dynamically, and launch beautiful pages with zero friction."
            },
            card: {
                title: "Card Block (JSON Array)",
                description: "Provide a JSON array of objects. Available icons: bi-sliders, bi-shield-lock, bi-graph-up-arrow, bi-lightning, bi-shield, bi-globe, bi-app-indicator, bi-patch-check.",
                template: JSON.stringify([
                    {
                        "title": "Extremely Customizable",
                        "text": "Tailor every component to match your unique brand identity with deep modular blocks.",
                        "icon": "bi-sliders"
                    },
                    {
                        "title": "Enterprise Security",
                        "text": "Bank-grade security protocols, automatic threat detection, and encrypted data structures.",
                        "icon": "bi-shield-lock"
                    },
                    {
                        "title": "Realtime Analytics",
                        "text": "Track your conversions, active sessions, and engagement with our native live dashboards.",
                        "icon": "bi-graph-up-arrow"
                    }
                ], null, 4)
            },
            list: {
                title: "List Block (Comma-Separated)",
                description: "Write a comma-separated list of items. We will parse and render each element inside a list bullet.",
                template: "Zero-downtime deployment workflows, Comprehensive API reference and tutorials, Integrated visual block builder, Native localization and multi-language support"
            },
            stats: {
                title: "Stats Block (JSON Array)",
                description: "Provide a JSON array of objects containing a 'number' and a 'label'.",
                template: JSON.stringify([
                    {"number": "99.99%", "label": "Server Uptime"},
                    {"number": "250M+", "label": "API Requests/Day"},
                    {"number": "15k+", "label": "Global Customers"},
                    {"number": "< 50ms", "label": "Average Response Time"}
                ], null, 4)
            }
        };

        function updateGuide() {
            const selectedType = $('#type').val();
            if (selectedType && guides[selectedType]) {
                const guide = guides[selectedType];
                $('#guide-title').text(guide.title);
                $('#guide-description').text(guide.description);
                $('#guide-template').text(guide.template);
                $('#content-guide').removeClass('d-none');
            } else {
                $('#content-guide').addClass('d-none');
            }
        }

        // On Type Select Change
        $('#type').on('change', updateGuide);
        
        // Populate current guide if type is pre-filled
        if($('#type').val()){
            updateGuide();
        }

        // Use template helper button
        $('#use-template-btn').on('click', function() {
            const selectedType = $('#type').val();
            if (selectedType && guides[selectedType]) {
                $('#content').val(guides[selectedType].template);
            }
        });
    });
</script>
@endsection
