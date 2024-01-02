<script src="https://cdn.tailwindcss.com"></script>
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-400 focus:bg-slate-400 active:bg-slate-800 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
