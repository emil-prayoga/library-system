@if ($paginator->hasPages())
<div style="display:flex;justify-content:center;gap:0.5rem;padding:1.5rem;flex-wrap:wrap;align-items:center;">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="padding:0.5rem 1rem;background:#e5e7eb;color:#9ca3af;border-radius:0.375rem;">
            ← Sebelumnya
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:0.5rem 1rem;background:#667eea;color:white;border-radius:0.375rem;text-decoration:none;font-weight:600;">
            ← Sebelumnya
        </a>
    @endif

    {{-- Pages --}}
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        @if ($i == $paginator->currentPage())
            <span style="padding:0.5rem 1rem;background:#667eea;color:white;border-radius:0.375rem;font-weight:600;">
                {{ $i }}
            </span>
        @else
            <a href="{{ $paginator->url($i) }}" style="padding:0.5rem 1rem;background:#f3f4f6;color:#374151;border-radius:0.375rem;text-decoration:none;font-weight:600;">
                {{ $i }}
            </a>
        @endif
    @endfor

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:0.5rem 1rem;background:#667eea;color:white;border-radius:0.375rem;text-decoration:none;font-weight:600;">
            Berikutnya →
        </a>
    @else
        <span style="padding:0.5rem 1rem;background:#e5e7eb;color:#9ca3af;border-radius:0.375rem;">
            Berikutnya →
        </span>
    @endif

</div>
@endif
