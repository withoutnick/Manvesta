<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My posts') }}
        </h2>
    </x-slot>

    @if (\Session::has('status'))
        <x-alert-success>{!! \Session::get('status') !!}</x-alert-success>
    @endif

    @if($posts->isNotEmpty())
    <x-full-width-card class="py-12">
        <section>

            {{ $posts->links() }}
            <div class="overflow-x-auto">
            <table class="border-collapse table-auto w-full">
                <thead class="bg-white border-b">
                    <tr>
                        <x-th>{{ __('Title') }}</x-th>
                        <x-th>{{ __('Published') }}</x-th>
                        <x-th>{{ __('Last update') }}</x-th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <x-td>
                            <x-link href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</x-link>
                            @if($post->private)
                                <span class="text-gray-500">({{ __('Private') }})</span>
                            @endif
                        </x-td>
                        <x-td>
                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                        </x-td>
                        <x-td>
                        {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                        </x-td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </section>
    </x-full-width-card>
    @else
    <x-full-width-card class="py-12">
        {{ __('You do not have written any posts as of yet.') }}
        <x-link href="{{ route('post.create') }}">{{ __('Write your first one!') }}</x-link>
    </x-full-width-card>
    @endif
</x-app-layout>
