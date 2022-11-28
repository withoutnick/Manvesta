<form id="updateForm" method="post" action="{{ route('post.update', $post->id) }}">
    @csrf
    @method('patch')

    <x-full-width-card class="py-12 pb-6"> 
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Post content') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("When you write, make sure to write something meaningful") }}
                </p>
            </header>

            <div class="mt-6 space-y-6">

                <div>
                    <x-input-label for="title" :value="__('Post title')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label for="content" :value="__('Content')" />
                    
                    <x-wysiwyg-editor name="content" class="mt-1 block w-full" >
                        {!! old('content', $post->content) !!}
                    </x-wyswyg-editor>
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>
            </div>
        </section>
    </x-full-width-card>
    <x-full-width-card class="pb-6">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Post settings') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Manage your post settings here") }}
            </p>
        </header>
        <div class="mt-6 space-y-6">
            <x-checkbox-input id="private" name="private" type="checkbox" :checked="old('private', $post->private)" /> 
            <label for="private" class="ml-2 font-medium text-sm text-gray-700">{{ __("Make this post private") }}</label>
        </div>
    </section>
    </x-full-width-card>

    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <x-primary-button form="updateForm">{{ __("Save changes") }}</x-primary-button>
        <x-danger-button form="deleteForm">{{ __("Delete post") }}</x-primary-button>
    </div>
</form>

<form id="deleteForm" method="post" class="align-center" action="{{ route('post.destroy', $post->id) }}">
    @csrf
    @method('delete')
</form>