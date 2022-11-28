<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create post') }}
        </h2>
    </x-slot>

    @include('post.partials.create-post-form')
</x-app-layout>

