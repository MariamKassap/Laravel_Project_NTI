@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-white border-2 border-black rounded-lg px-3 py-2 text-black shadow-[2px_2px_0px_0px_#000000] placeholder:text-gray-500 focus:ring-0 focus:outline-none focus:border-black disabled:opacity-50 disabled:bg-gray-100']) }}>
