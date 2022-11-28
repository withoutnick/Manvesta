@props(['url'])
<h2 class="text-xl font-bold mb-1">
    @if(isset($url))
    <a href="{{ $url }}" class="hover:underline">
        {{ $slot }}
    </a>
    @else
        {{ $slot }}
    @endif
</h2>