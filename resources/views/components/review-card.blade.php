@props(['name', 'rating' => 5])

<article {{ $attributes->merge(['class' => 'group relative min-w-[300px] max-w-[350px] sm:min-w-[350px] shrink-0 snap-start rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition-all hover:shadow-md']) }}>
    <div class="mb-4 flex items-center gap-3">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="8" r="3.2" stroke-width="1.8" />
                <path d="M5.5 19a6.5 6.5 0 0 1 13 0" stroke-width="1.8" stroke-linecap="round" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-900">{{ $name }}</h3>
            <div class="mt-1 flex items-center gap-1.5">
                <div class="flex items-center text-amber-400">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < floor($rating))
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                            </svg>
                        @elseif ($i < ceil($rating))
                            {{-- Half Star approach: color half of it. Simplest is a custom SVG or just full color but opacity --}}
                            <svg class="h-4 w-4 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                <defs>
                                    <linearGradient id="half-{{ $i }}-{{ Str::slug($name) }}" x1="0" x2="100%" y1="0" y2="0">
                                        <stop offset="50%" stop-color="currentColor" />
                                        <stop offset="50%" stop-color="#D1D5DB" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#half-{{ $i }}-{{ Str::slug($name) }})" d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                            </svg>
                        @else
                            <svg class="h-4 w-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                <path d="M10 1.5 12.6 6.8l5.9.9-4.3 4.2 1 5.9L10 15.5l-5.2 2.8 1-5.9L1.5 7.7l5.9-.9L10 1.5z" />
                            </svg>
                        @endif
                    @endfor
                </div>
                <span class="text-xs font-semibold text-gray-700">{{ number_format($rating, 1) }}/5</span>
            </div>
        </div>
    </div>
    <p class="text-sm leading-relaxed text-justify text-gray-600">
        {{ $slot }}
    </p>
</article>
