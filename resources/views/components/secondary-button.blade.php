<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center bg-white text-black font-bold border-2 border-black rounded-lg px-4 py-2 shadow-[2px_2px_0px_0px_#000000] hover:bg-slate-100 hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-[4px_4px_0px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-0']) }}>
    {{ $slot }}
</button>
