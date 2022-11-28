<x-small-text>{{ __('You are commenting as :name', ['name' => auth()->user()->name]) }}</x-small-text>
<form action="{{ route('comment.store') }}" method="POST" class="mt-3">
    @csrf
    <x-textarea-input name="comment" rows="10" required min="3" max="5000" placeholder="{{ __('Your comment') }}"></x-textarea-input>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <x-primary-button class="mt-5">Submit</x-primary-button>
</form>