<button {{ $attributes->merge(['type' => 'submit', 'class' => 'border border-emerald-400 font-medium text-white bg-transparent transition-all hover:bg-emerald/10 hover:border-emerald-200 focus:outline-none focus:ring-2 focus:ring-emerald-400 active:scale-95']) }}>
    {{ $slot }}
</button>