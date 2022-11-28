<article class="flex flex-col content-start p-4 mt-5 sm:mt-0 sm:p-8 bg-white shadow sm:rounded-lg">
    <header class="w-full">
        <x-post-card-heading :url="route('post.single', $post->id)">
            {{ $post->title }}
        </x-post-card-heading>
        <x-small-text>
            {{ $post->updatedBefore() }} by {{ $post->user->name }}
            @if($post->private)
                | {{ __('private') }}
            @endif
        </x-small-text>
    </header>
    <main class="mt-2 mb-auto w-full">
        {{ $post->excerpt(20) }}
    </main>
    <footer class="mt-5 w-full place-self-end">
       <x-primary-button-link href="{{ route('post.single', $post->id) }}">
            {{ __('Read more') }}
        </x-primary-button-link>
    </footer>
</article>
