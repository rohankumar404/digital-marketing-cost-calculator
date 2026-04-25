<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-brand border border-transparent rounded-xl font-bold text-sm text-black uppercase tracking-widest hover:bg-white focus:bg-white active:bg-white focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
