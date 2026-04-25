@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[#181818] border-[#333] text-white focus:border-brand focus:ring-brand rounded-xl shadow-sm py-3 px-4 transition-all duration-300']) !!}>

