<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit post') }}
        </h2>
    </x-slot>
    
    @if (\Session::has('status'))
        <x-alert-success>{!! \Session::get('status') !!}</x-alert-success>
    @endif

    @include('post.partials.update-post-form')
</x-app-layout>

