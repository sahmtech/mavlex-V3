

<div class="mb-4 bg-white shadow-sm rounded-3 border border-light">
    <div class="p-4 p-sm-5">
        <div class="d-flex align-items-center gap-4">
            @if (!empty($svg))
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0 {{ $svg_bg }} {{ $svg_text }}" 
                     style="width: 2.5rem; height: 2.5rem;">
                    {!! $svg !!}
                </div>
            @endif

            <div class="flex-grow-1 w-100">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
