<x-app-layout>
    
    <article>
        <header class="bg-indigo-700 w-full mb-5 sm:mb-15 md:mb-20">
            <div class="max-w-7xl mx-auto p-10 sm:p-20 px-4 sm:px-6 lg:px-8 prose lg:prose-xl">
                <h1 class="text-white">{{ $post->title }}</h1>
                <div class="text-indigo-200">
                    Posted by: <b>{{ $post->user->name }}</b> &middot;
                    {{ $post->updatedBefore() }}
                </div>
            </div>
        </header>
        <main class="max-w-3xl text-lg mx-auto pb-10 px-4 sm:px-6 lg:px-8 prose lg:prose-xl">
            {!! $post->content !!}
        </main>
    </article>

    @if(!$post->private)
        @include('post.partials.comments-list')
    @endif
</x-app-layout>