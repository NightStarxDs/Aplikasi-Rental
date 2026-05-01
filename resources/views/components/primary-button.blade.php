<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-emerald-800 font-semibold text-white transition-all hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95']) }}>
    {{ $slot }}
</button>
