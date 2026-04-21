@props(['disabled' => false])

<div class="flex h-12 items-center gap-2 rounded-xl border bg-emerald-50 px-3 transition-all focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-emerald-200' }}">
<input @disabled($disabled) {{ $attributes->merge(['class' => 'flex-1 border-none bg-transparent text-md font-medium text-emerald-900 outline-none placeholder-emerald-300 focus:ring-0']) }}>
</div>