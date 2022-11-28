@php
    $classes = 'form-control block w-full px-4 py-4 text-gray-700 bg-white border border-solid border-gray-300 roundedfocus:border-blue-600 focus:outline-none';    
@endphp

<textarea {{ $attributes->merge(['class' => $classes]) }}">{{ $slot }}</textarea>