<button {{ $attributes->merge(['type' => 'button', 'class' => 'border border-emerald-400 text-sm font-semibold text-emerald-200 transition-colors hover:bg-emerald-50 focus:outline-none hover:text-emerald-300']) }}>
    {{ $slot }}
</button>
