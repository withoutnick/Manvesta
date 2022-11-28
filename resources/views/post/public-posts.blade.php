<x-app-layout>
    
    <x-page-heading>{{ __('Our Library') }}</x-page-heading>

    @if($posts->isNotEmpty())
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:grid grid-cols-2 gap-5">
        @foreach($posts as $post)
            @include('post.partials.post-card')
        @endforeach
        </div>
        <div class="mt-10 pb-20">
        {!! $posts->links() !!}
        </div>
    </div>  
    @else

        <div class="text-center">
            {{ __('No posts available.') }}
        </div>

    @endif

</x-app-layout>