<div class="mb-6">
<br>
    <h2 class="font-semibold text-2xl gold-text leading-tight">
        {{ $title }}
    </h2>

    @if(count($breadcrumbs))
        <nav class="text-sm text-gray-400 mt-2">

            @foreach($breadcrumbs as $breadcrumb)

                @if(!$loop->last)

                    <a
                        href="{{ $breadcrumb['href'] }}"
                        class="hover:text-[#D4AF37]"
                    >
                        {{ $breadcrumb['name'] }}
                    </a>

                    /

                @else

                    <span class="text-white">
                        {{ $breadcrumb['name'] }}
                    </span>

                @endif

            @endforeach

        </nav>
    @endif

</div>