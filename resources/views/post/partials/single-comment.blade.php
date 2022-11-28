<article class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg" id="{{ $comment->id }}">
    <header>
        <span class="font-bold mr-2">{{ $comment->user->name }}</span>&middot; 
        <x-small-text>{{ $comment->postedBefore() }}</x-small-text> 
    </header>
    <main class="mt-2">
        {{ $comment->comment }}
    </main>
</article>