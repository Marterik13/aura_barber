<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#D4AF37] border border-transparent rounded-full font-bold text-xs text-black uppercase tracking-widest hover:bg-[#FFD700] focus:bg-[#FFD700] active:bg-[#B38728] focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:ring-offset-2 focus:ring-offset-[#0D0D0D] disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
