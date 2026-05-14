<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#0D0D0D]">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-[#1A1A1A] border border-gray-800 shadow-2xl overflow-hidden sm:rounded-2xl">
        {{ $slot }}
    </div>
</div>
